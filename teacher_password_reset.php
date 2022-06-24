<?php
require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if (empty($e)) {
    echo "Missing email address";
} else if (empty($np)) {
    echo "Please enter your new password";
} else if (strlen($np) < 5 || strlen($np) > 20) {
    echo "Password length must between 5 to 20";
} else if (empty($rnp)) {
    echo "Please Re-type your password";
} else if ($np != $rnp) {
    echo "Password and Re-type password does not match";
} else if (empty($vc)) {
    echo "Please enter your verification code";
} else {

    //search details from teachers table
    $rs = Database::search("SELECT * FROM `teachers` WHERE `email`='" . $e . "' AND `verification_code`='" . $vc . "'");

    //if row count is equals to 1 
    if ($rs->num_rows == 1) {

        //update teachers table
        Database::iud("UPDATE `teachers` SET `password`='" . $np . "' WHERE `email`='" . $e . "'");
        echo 1;
    } else {
        echo "Password Reset Fail";
    }
}
