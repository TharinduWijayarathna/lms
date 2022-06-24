<?php
require "connection.php";

$code = $_POST["code"];
$username = $_POST["username"];
$password = $_POST["password"];

//check and update academic officers verification id

$search = Database::search("SELECT * FROM `academic_officers` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "' AND `verification_code` ='" . $code . "'");
$nm = $search->num_rows;

if ($nm == 1) {
    //update table
    Database::iud("UPDATE `academic_officers` SET `verification_id`='1' WHERE `username` = '" . $username . "' AND `password` = '" . $password . "' AND `verification_code` ='" . $code . "'");
    //success messege
    echo 1;
} else {
    echo "System Error";
}
