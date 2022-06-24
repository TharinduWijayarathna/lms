<?php
session_start();

require "connection.php";

$nic = $_POST["nic"];
$password = $_POST["password"];
$email = $_POST["email"];


//search details from students

$rs = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "' AND `password`='" . $password . "' AND `email` = '" . $email . "'");
$n = $rs->num_rows;

//is there any row
if ($n == 1) { //Sign in Success 

    //search details from students
    $trial = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "' AND `password`='" . $password . "' AND `email` = '" . $email . "' AND `trial_or_paid_id` = '1'");
    $trial_num = $trial->num_rows;

    //if value is equals to 1
    if ($trial_num == 1) {

        //assign to a session
        $data = $trial->fetch_assoc();
        $_SESSION["pd"] = $data;

        echo 1;
    } else {
        echo 2;
    }
} else {
    echo "Invalid Details";
}
