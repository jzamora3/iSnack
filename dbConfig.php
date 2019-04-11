<?php
//DB details

$dbHost = 'jzamora4.create.stedwards.edu';
$dbUsername = 'jzamorac';
$dbPassword = 'IHk2875ski';
$dbName = 'jzamorac_doslocos';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}