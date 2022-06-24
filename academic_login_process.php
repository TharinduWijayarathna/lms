<?php
session_start();

require "connection.php";

$username = $_POST["username"];
$password = $_POST["password"];
$remember = $_POST["remember"];

//search active academic officers
$rs = Database::search("SELECT * FROM `academic_officers` WHERE `username`='" . $username . "' AND `password`='" . $password . "' AND `status_id` = '1'");
$n = $rs->num_rows;

//search blcoked academic officers
$blk = Database::search("SELECT * FROM `academic_officers` WHERE `username`='" . $username . "' AND `password`='" . $password . "' AND `status_id` = '2'");
$bs = $blk->num_rows;

if ($n == 1) { //Sign in Success 

    //check verification id is equal to 1
    $verified = Database::search("SELECT * FROM `academic_officers` WHERE `username`='" . $username . "' AND `password`='" . $password . "' AND `status_id` = '1' AND `verification_id` = '1'");
    $verification_done = $verified->num_rows;

    //if row count is equals to 1
    if ($verification_done == 1) {


        //assign data to a session
        $data = $rs->fetch_assoc();
        $_SESSION["o"] = $data;

        if ($remember == "true") { //when remember me is true 
            setcookie("ou", $username, time() + (60 * 60 * 24 * 365));
            setcookie("op", $password, time() + (60 * 60 * 24 * 365));
        } else { //when remember me is false
            setcookie("ou", "", -1);
            setcookie("op", "", -1);
        }

        echo "Success";
    } else {
        //id not equal to 1
        echo 1;
    }
} else if ($bs == 1) {
    //if status is blocked
    echo "You have been blocked";
} else {
    echo "Invalid Details";
}
