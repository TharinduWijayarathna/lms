<?php
session_start();

require "connection.php";

//time zone
date_default_timezone_set('Asia/Colombo');

$nic = $_POST["nic"];
$password = $_POST["password"];
$remember = $_POST["remember"];

//search details from active students table
$rs = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "' AND `password`='" . $password . "' AND `status_id` = '1'");
$n = $rs->num_rows;

//search details from blocked students table
$blk = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "' AND `password`='" . $password . "' AND `status_id` = '2'");
$bs = $blk->num_rows;

if ($n == 1) { //Sign in Success 

    //search details of verified students from students table
    $verified = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "' AND `password`='" . $password . "' AND `status_id` = '1' AND `verification_id` = '1'");
    $verification_done = $verified->num_rows;

    //if row count is eqauls to 1
    if ($verification_done == 1) {

        //search paid details from students table
        $paid_or_not = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "' AND `password`='" . $password . "' AND `status_id` = '1' AND `verification_id` = '1' AND `trial_or_paid_id` = '2'");
        $pnum = $paid_or_not->num_rows;

        //if row count is equals to 1
        if ($pnum == 1) {

            //assign data to a session
            $data = $rs->fetch_assoc();
            $_SESSION["s"] = $data;

            //search details from payment data table
            $paid_search = Database::search("SELECT * FROM `payment_data` WHERE `students_id` = '" . $data["id"] . "'");
            $pdata = $paid_search->fetch_assoc();

            //set dates
            $paid_date =  strtotime($pdata["date"]);
            $ex_date = strtotime(date("Y-m-d"));

            //get date count
            $year = ($ex_date - $paid_date) / 60 / 60 / 24;

            //if count is greater than or equals to 365 
            if ($year >= 365) {
                //upadate students table
                Database::iud("UPDATE `students` SET `trial_or_paid_id` = '1' WHERE `id` = '" .  $data["id"]  . "'");

                echo 2;
            } else {

                //set cookies
                if ($remember == "true") { //when remember me is true 
                    setcookie("su", $nic, time() + (60 * 60 * 24 * 365));
                    setcookie("sp", $password, time() + (60 * 60 * 24 * 365));
                } else { //when remember me is false
                    setcookie("su", "", -1);
                    setcookie("sp", "", -1);
                }

                echo "Success";
            }
        } else {

            //search not paid details from students table
            $not_paid = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "' AND `password`='" . $password . "' AND `status_id` = '1' AND `verification_id` = '1' AND `trial_or_paid_id` = '1'");
            $npdata = $not_paid->fetch_assoc();

            //set dates
            $start_date = strtotime($npdata["registered_on"]);
            $today = strtotime(date("Y-m-d"));

            //get date count
            $differnce = ($today - $start_date) / 60 / 60 / 24;

            //if date count is greater than or equals to 30
            if ($differnce >= 30) {
                echo 2;
            } else {
                //add data to a session
                $data = $rs->fetch_assoc();
                $_SESSION["s"] = $data;

                if ($remember == "true") { //when remember me is true 
                    setcookie("su", $nic, time() + (60 * 60 * 24 * 365));
                    setcookie("sp", $password, time() + (60 * 60 * 24 * 365));
                } else { //when remember me is false
                    setcookie("su", "", -1);
                    setcookie("sp", "", -1);
                }

                echo 3;
            }
        }
    } else {
        echo 1;
    }
} else if ($bs == 1) {
    echo "You have been blocked";
} else {
    echo "Invalid Details";
}
