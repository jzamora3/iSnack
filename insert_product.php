<?php
$connect = mysqli_connect('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
if (isset($_POST['details'])) {
    $cost = $_POST['cost'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $vendor = $_POST['vendor'];
    $picture = $_POST['picture'];


    $image = addslashes(file_get_contents($_FILES['picture']['tmp_name'])); //SQL Injection defence!
  
        if (empty($image)) $image = "images/iconServer.png";

    $sql = "INSERT INTO `Product` (`id`,`cost`,`name`,`details`,`available`,`quantity`, `picture`,`vendor`, `image_name`) VALUES (0, $cost,'$name','$details',0,0,'{$image}',$vendor,'{$image_name}')";
        if (!mysqli_query($connect, $sql)) { // Error handling
            echo "Something went wrong! :("; 
        }
        else{
            header('Location: admin.php?products');
        }
}
?>