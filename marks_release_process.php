<?php

session_start();

require "connection.php";

$id = $_POST["id"];
$status = $_POST["status"];

//is there any value in $id 
if (isset($id)) {

    //if $status equals to 1
    if ($status == 1) {

        //update student results table
        Database::iud("UPDATE `student_results` SET `officer_viewed_status_id` = '1' WHERE `id` = '" . $id . "'");

        echo 1;
        //if $status equals to 2
    } else if ($status == 2) {
        //update student results table
        Database::iud("UPDATE `student_results` SET `officer_viewed_status_id` = '2' WHERE `id` = '" . $id . "'");

        echo 1;
    }
} else {
    echo "Error";
}
