<?php
require_once'db.php';
$_SESSION = array();
session_destroy();
header('Location: portal.html');
?>