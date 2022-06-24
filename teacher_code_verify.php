<?php
require "connection.php";

$code = $_POST["code"];
$username = $_POST["username"];
$password = $_POST["password"];

//search details from teachers table
$search = Database::search("SELECT * FROM `teachers` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "' AND `verification_code` ='" . $code . "'");
$nm = $search->num_rows;

//if row count is equals to 1
if ($nm == 1) {
    //update teachers
    Database::iud("UPDATE `teachers` SET `verification_id`='1' WHERE `username` = '" . $username . "' AND `password` = '" . $password . "' AND `verification_code` ='" . $code . "'");

    echo 1;
} else {
    echo "System Error";
}
