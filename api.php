<?php
isset($_SESSION) or session_start();
//robust database class offering logins, signups, and queries protected by prepared sql statements.
class db {
    private static $db; //singleton variable: used to store mysqli connection until php script dies
    public static function &get(): mysqli {
        if (!self::$db) self::mysqliConnect(); //create mysqli unless one is active in at self::$db
        return self::$db;
    }
    private static function mysqliConnect(): void { //assigns new mysqli to private static var self::$db
        self::$db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
        if (self::$db->connect_error) exit("db connection failed: " . self::$db->connect_error);
    }
    //prepared sql statement looks for exactly one record with the given email and verifies password
    public static function login(string $email, string $password): bool {
        if ($prep = self::get()->prepare('SELECT`id`,`username`,`password`FROM`Account`WHERE`email`=?
        LIMIT
        1')) {
            $prep->bind_param('s', $email);
            $prep->execute();
            $prep->store_result();
            if ($prep->num_rows === 1) {
                $prep->bind_result($id, $username, $db_pass); 
                $prep->fetch();
                if (password_verify($password, $db_pass)) { //hashes match
                    $_SESSION['id'] = $id; $_SESSION['email'] = $email; $_SESSION['username'] = $username;
                    return true;
                }
            }
        }
        return false;
    }
    //used by the listener over in public_html to ensure no special characters were injected
    public static function scrub(string $url): string {
        if ('' == $url) return $url;
        $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
        $strip = array('%0d', '%0a', '%0D', '%0A');
        $url = (string) $url;
        $count = 1;
        while ($count) $url = str_replace($strip, '', $url, $count);
        $url = str_replace(';//', '://', $url);
        $url = htmlentities($url);
        $url = str_replace('&amp;', '&#038;', $url);
        $url = str_replace("'", '&#039;', $url);
        if ($url[0] !== '/') return '';
        return $url;
    }
    //attempt to create new account; if successful, return vendor list, otherwise err message
    public static function signup(string $username, string $email, string $password): bool {
        if ($prep = self::get()->prepare('SELECT`email`FROM`Account`WHERE`email`=?
        LIMIT
        1')) {
            $prep->bind_param('s', $email);
            $prep->execute();
            $prep->store_result();
            if ($prep->num_rows === 0) {
                $hash = password_hash($password, CRYPT_BLOWFISH);
                $sql = "INSERT
                INTO`Account`VALUES(0,'$username','$email','$hash');";
                if (!(self::get()->query($sql))) exit(self::get()->error);
                return db::login($email, $password);
            }
        }
        return false;
    }
    //executes a line of sql and returns results/records as an encoded json string. note that this
    //method should remain PRIVATE, with more controlled public functions using it as a go-between
    public static function sql(string $query): array {
        $results = self::get()->query($query);
        if (!$results) exit(self::get()->error);
        $records = array();
        while ($row = $results->fetch_assoc()) $records[] = $row;
        return $records;
    }
    //example of a public method that uses the sql() method above in a controlled, limited way
    public static function getProducts(string $vendor): array {
        return db::sql("select*from`Product`where`vendor`=$vendor;");
    }
    //attempt to insert the json-encoded Product object passed in as parameter $json. return OK or error
    public static function insertProduct($cost, $name, $details, $vendor) {
        $insert = "INSERT
        INTO`Product`VALUES(0,$cost,\"$name\",\"$details\",0,0,\"\",$vendor);";
        return self::get()->query($insert);
    }
    //simple update for use with live table editing via ajax, e.g. UPDATE $table SET $field=$value $where
    public static function delete($table, $id) {
        $delete = "DELETE
        FROM
        `$table`WHERE`id`=$id;";
        return self::get()->query($delete);
    }
    //simple update for use with live table editing via ajax, e.g. UPDATE $table SET $field=$value $where
    public static function update($table, $field, $value, $where) {
        $update = "UPDATE`$table`SET`$field`='$value'WHERE`id`=$where;";
        return self::get()->query($update);
    }
    //attempt to insert the json-encoded Vendor object passed in as parameter $json. return OK or error
    public static function insertVendor($name, $address, $details, $account): bool {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => "locate=$address&json=1", CURLOPT_URL => 'https://geocode.xyz/'
        ]);
        $res = curl_exec($ch);
        $geo = json_decode($res, false, 4);
        curl_close ($ch);
        $latitude = 0;
        $longitude = 0;
        if ($geo && $geo->latt && $geo->longt) {
            $latitude = $geo->latt;
            $longitude = $geo->longt;
        }
        $insert = "INSERT
        INTO`Vendor`VALUES(0,\"$name\",\"$address\",\"$details\",\"$latitude\",\"$longitude\",$account);";
        if (self::get()->query($insert)) return true;
        echo self::get()->error; return false;
    }
    //attempt to insert the json-encoded Vendor object passed in as parameter $json. return OK or error
    public static function insertEmployee($name, $email, $phone, $wage, $account, $vendor): bool {
        $insert = "INSERT
        INTO`Employee`VALUES(0,\"$name\",\"$email\",\"$phone\",now(),null,$wage,0,$account, $vendor);";
        return self::get()->query($insert);
    }
    //mass-getter for all vendors currently in the database
    public static function populate($account): void {
        if (!isset($_SESSION, $_SESSION['id']) || $_SESSION['id'] != $account) return;
        $_SESSION['employees'] = db::sql("select`Employee`.id,`Employee`.name,`Employee`.email,`phone`,`wage`,`hours_worked`as`Hours Worked`,`Vendor`.name
        as`Vendor`from`Employee`,`Vendor`where`Employee`.vendor=`Vendor`.id
        and`Vendor`.account=$account;");
        $_SESSION['products'] = db::sql("select`Product`.id,`Product`.name,`Product`.details,`cost`,`quantity`,`Vendor`.name
        as`Vendor`from`Product`,`Vendor`where`Product`.vendor=`Vendor`.id
        and`Vendor`.account=$account;");
        $_SESSION['vendors'] = db::sql("select`id`,`name`,`address`,`details`,`latitude`,`longitude`from`Vendor`where`account`=$account;");
    }
    //store a picture file as "text" in the database using base64. postponed until basic functionality
    public static function store(string $source_path): bool {
        $destination_path = __DIR__.'/../'.$id.'/';
        if (!is_dir($destination_path)) mkdir($destination_path);
        $i = time() + microtime();
        $b64 = base64_encode(file_get_contents($source_path));
        $sql = "INSERT
        INTO`Resource`VALUES($id,'$b64');";
        return self::get()->query($sql);
    }
    //draws a table from an associative array
    public function table(array $data): string {
        if (!$data || !$data[0]) return '';
        $string = '<table class="display" width="100%" id="dataTable"><thead><tr id="header">';
        foreach ($data[0] as $key => $val) {
            if ($key == 'id') $string .= "<th><form action=\"index.php\" method=\"post\"><button class=\"dt-button\" type=\"submit\" method=\"post\" name=\"".view()."\">Delete</button></th>";
            else $string .= "<th>".ucwords($key)."</th>";
        }
        $string .= '</tr></thead><tbody>';
        foreach ($data as $row) {
            $string.= '<tr>';
            foreach($row as $key => $val) {
                $string .= "<td id=\"$key\">";
                if ($key == 'id') $string .= "<input name=\"$key\" required=\"\" type=\"radio\" value=\"$val\">";
                $string .= "$val</td>";
            }
            $string .= '</tr>';
        }
        $string .= '</form></tbody></table>';
        return $string;
    }
}
function view(): string {
    if (isset($_GET['employees']))     return 'Employee';
    else if (isset($_GET['products'])) return 'Product';
    else if (isset($_GET['vendors']))  return 'Vendor';
    else if (isset($_GET['orders']))   return 'Order';
    else return 'Account';
}
