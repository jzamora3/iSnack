<?php

function userRating($customerId, $productId, $db)
{
    $average = 0;
    $avgQuery = "SELECT rating FROM tbl_rating WHERE customer_id = '" . $customerId . "' and product_id = '" . $productId . "'";
    $total_row = 0;
    //$db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
    
    if ($result = mysqli_query($db, $avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf
    
    if ($total_row > 0) {
        foreach ($result as $row) {
            $average = round($row["rating"]);
        } // endForeach
    } // endIf
    return $average;
}
 // endFunction
function totalRating($productId, $db)
{
    $totalVotesQuery = "SELECT * FROM tbl_rating WHERE product_id = '" . $productId . "'";
    //$db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
    
    if ($result = mysqli_query($db, $totalVotesQuery)) {
        // Return the number of rows in result set
        $rowCount = mysqli_num_rows($result);
        // Free result set
        mysqli_free_result($result);
    } // endIf
    
    return $rowCount;
}//endFunction
function avgRating($productId, $db)
{
    $avgQuery = "SELECT ROUND(AVG(rating),1) AS average FROM tbl_rating WHERE product_id = '" . $productId . "'";
    //$db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
    
    if ($result = mysqli_query($db, $avgQuery)) {
        // Return the number of rows in result set
        $row = mysqli_fetch_assoc($result); 
        $average = $row['average'];
        // Free result set
        mysqli_free_result($result);
    } // endIf
    
    return $average;
}//endFunction

function get_promotion_details($name)
        {
        
            $db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
            $rValue = "";
            $sql = "SELECT discount FROM Promotion WHERE name = '" . $name . "'";
    
         

                if ($result = mysqli_query($db, $sql)) {
                $row = mysqli_fetch_assoc($result);
                $rValue = $row['discount'];
                mysqli_free_result($result);
            }
            return $rValue;
        }
function get_product_price($name)
        {
        
            $db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
            $rValue = "";
            $sql = "SELECT cost FROM Product WHERE name = '" . $name . "'";
    
         

                if ($result = mysqli_query($db, $sql)) {
                $row = mysqli_fetch_assoc($result);
                $rValue = $row['cost'];
                mysqli_free_result($result);
            }
            return $rValue;
        }
function totalSaved($name,$quantity){
    $price = get_product_price($name);
    $percentInDecimal = get_promotion_details($name) / 100;
    $discount = $percentInDecimal * $price;
    $discountedPrice = $price - $discount;
    
    $totalPrice = $price * $quantity;
    $totalDiscount = $discountedPrice * $quantity;
    
    $totalSaved = $totalPrice - $totalDiscount;
    
    return $totalSaved;
    
    
}
function verifyPurchase($customerId,$productId)
        {
        
            $db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
            $rValue = "";
            $sql = "SELECT id FROM order_items WHERE customer_id = '" . $customerId . "' and product_id = '" . $productId . "'";
            
    
         

                if ($result = mysqli_query($db, $sql)) {
                $row = mysqli_fetch_assoc($result);
                $rValue = $row['id'];
                mysqli_free_result($result);
            }
            if ($rValue == null){
                return FALSE;
            }
            else{
              return TRUE;  
            }
            
        }
?>