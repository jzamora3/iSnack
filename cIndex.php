<?php
//header('Access-Control-Allow-Origin: *');
require_once'db.php';
//echo "Hello";

//catch Customer signup
if (isset($_POST['username'])) {
    $password = $_POST['password_1'] or $password = $_POST['password'];
    $password == $_POST['password_2'] or exit('Passwords do not match!');
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    if (db::customerSignup($username, $email,$phone,$address, $password)) header('Location: customerIndex.php?customers');
    else header('Location: customerPortal.html?error=email_taken');
}
//catch Customer login
else if (isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (db::customerLogin($email, $password) === true) header('Location: customerIndex.php?customers');
    else header('Location: customerPortal.html?error=invalid_login');
}

//if logged in, redirect to admin site
else if (isset($_SESSION['id']))
    header('Location: customerIndex.php?vendors');
//if not, redirect to login/signup forms
else header('Location: customerPortal.html');
?>