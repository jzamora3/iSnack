<?php
require_once ('db.php');
require_once "functions.php";

$_SESSION['sessCustomerID'] = $_SESSION['id'];
$customerId = $_SESSION['sessCustomerID'];
$db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
if (isset($_POST["index"], $_POST["product_id"])) {
    
    $productId = $_POST["product_id"];
    $rating = $_POST["index"];
    
    $checkIfExistQuery = "select * from tbl_rating where customer_id = '" . $customerId . "' and product_id = '" . $productId . "'";
    if ($result = mysqli_query($db, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    $verifiedPurchase = verifyPurchase($customerId,$productId);

    if($verifiedPurchase){
            if ($rowcount == 0) {
                $insertQuery = "INSERT INTO tbl_rating(customer_id,product_id, rating) VALUES ('" . $customerId . "','" . $productId . "','" . $rating . "') ";
                $result = mysqli_query($db, $insertQuery);
                echo "Thanks for Rating!";
            } else {
                echo "Already Rated!";
            }
    } else {
        echo "You have not purchased this item before";
    }
    
}
?>