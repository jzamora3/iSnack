<?php
require_once "db.php";
require_once "functions.php";
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
$_SESSION['sessCustomerID'] = $_SESSION['id'];
$customerId = $_SESSION['sessCustomerID'];
$db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
$query = "SELECT * FROM Product ORDER BY id DESC";
$result = mysqli_query($db, $query);



$outputString = '';

foreach ($result as $row) {
    $userRating = userRating($customerId, $row['id'], $db);
    $totalRating = totalRating($row['id'], $db);
    $average = avgRating($row['id'], $db);
    
    $outputString .= '
    
        <div class="row-item">
 <div class="row-title">' . $row['name'] . '</div> <div class="response" id="response-' . $row['id'] . '"></div>
 <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $row['id'] . ',' . $userRating . ');"> ';
    
    for ($count = 1; $count <= 5; $count ++) {
        $starRatingId = $row['id'] . '_' . $count;
        
        if ($count <= $userRating) {
            
            $outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
        } else {
            $outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $row['id'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $row['id'] . ',' . $count . ');">&#9733;</li>';
        }
    } // endFor
    
    $outputString .= '
 </ul>
 
 <p class="review-note">Total Reviews: ' . $totalRating . '</p>
 <p class="review-note">Average Rating: ' . $average  . '</p>

</div>
 ';
}
echo $outputString;
?>