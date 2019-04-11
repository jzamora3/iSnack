<?php
require_once'db.php';
//catch ajax update
if (isset($_POST['field'])) {
    $table = $_POST['table'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    $where = $_POST['where'];
    if (db::update($table, $field, $value, $where)) header('Location: admin.php?'.lcfirst($table).'s');
    else header('Location: admin.php?error=update_failed');
}
//catch user signup
else if (isset($_POST['username'])) {
    $password = $_POST['password_1'] or $password = $_POST['password'];
    $password == $_POST['password_2'] or exit('Passwords do not match!');
    $email = $_POST['email'];
    $username = $_POST['username'];
    if (db::signup($username, $email, $password)) header('Location: admin.php?vendors');
    else header('Location: portal.html?error=email_taken');
}
//catch user login
else if (isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (db::login($email, $password) === true) header('Location: admin.php?vendors');
    else header('Location: portal.html?error=invalid_login');
}
//catcn new employee
else if (isset($_POST['wage'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $wage = $_POST['wage'];
    $account = $_SESSION['id'];
    $vendor = $_POST['vendor'];
    if (db::insertEmployee($name, $email, $phone, $wage, $account, $vendor)) header('Location: admin.php?employees');
    else header('Location: admin.php?error=insert_failed');
}
//catch new vendor
else if (isset($_POST['address'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $details = $_POST['details'];
    $account = $_SESSION['id'];
    if (db::insertVendor($name, $address, $details, $account)) header('Location: admin.php?vendors');
    else header('Location: admin.php?error=insert_failed');
}
//catch new Promotion
else if (isset($_POST['quantity'])) {
    $discount = $_POST['discount'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $quantity = $_POST['quantity'];
    $vendor = $_POST['vendor'];
    $productId = $_POST['productId'];
    if (db::insertPromotion($name, $details, $discount, $quantity, $vendor,$productId)) header('Location: admin.php?promotions');
    else header('Location: admin.php?error=insert_failed');
}
//catch new product
else if (isset($_POST['details'])) {
    $cost = $_POST['cost'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $vendor = $_POST['vendor'];
    $picture = $_POST['picture'];
    $image = file_get_contents($_FILES[$_POST['picture']]['tmp_name']);
    $image_name = addslashes($_FILES['picture']['name']);
    if (db::insertProduct($cost, $name, $details,$image, $vendor,$image_name)) header('Location: admin.php?products');
    else header('Location: admin.php?error=insert_failed');
}

//catch deletion (not yet implemented)
else if (isset($_POST['id'])) {
    $id = $_POST['id']; 
    if (db::deletePromotion($id)) header('Location: deleteItem.php#page-top');
    else header('Location: admin.php?error=delete_failed');
}
else if (isset($_POST['productId'])) {
    $id = $_POST['productId']; 
    if (db::deleteProduct($id)) header('Location: deleteItem.php#page-top');
    else header('Location: admin.php?error=delete_failed');
}
else if (isset($_POST['empId'])) {
    $id = $_POST['empId']; 
    if (db::deleteEmployee($id)) header('Location: deleteItem.php#page-top');
    else header('Location: admin.php?error=delete_failed');
}
else if (isset($_POST['locationId'])) {
    $id = $_POST['locationId']; 
    if (db::deleteVendor($id)) header('Location: deleteItem.php#page-top');
    else header('Location: admin.php?error=delete_failed');
}
//if logged in, redirect to admin site
else if (isset($_SESSION['id']))
    header('Location: admin.php?vendors');
//if not, redirect to login/signup forms
else header('Location: portal.html');
?>