<?php
require "connection.php";

$code = $_POST["code"];
$nic = $_POST["nic"];
$password = $_POST["password"];

//search details from students table

$search = Database::search("SELECT * FROM `students` WHERE `nic` = '" . $nic . "' AND `password` = '" . $password . "' AND `verification_code` ='" . $code . "'");
$nm = $search->num_rows;

//if row count is equals to 1
if ($nm == 1) {

    //update students table
    Database::iud("UPDATE `students` SET `verification_id`='1' WHERE `nic` = '" . $nic . "' AND `password` = '" . $password . "' AND `verification_code` ='" . $code . "'");

    echo 1;
} else {
    echo "System Error";
}
?>