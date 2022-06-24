<?php

session_start();

require "connection.php";

$id = $_POST["id"];
$status = $_POST["status"];

//is there any value on $id variable 
if (isset($id)) {

    //if $status value equals to 1
    if ($status == 1) {

        //update upload assignment table

        Database::iud("UPDATE `upload_assignment` SET `viewed_or_not_id` = '1' WHERE `id` = '" . $id . "'");

        echo 1;

        //if $status value equals to 2
    } else if ($status == 2) {

        //update upload assignment table

        Database::iud("UPDATE `upload_assignment` SET `viewed_or_not_id` = '2' WHERE `id` = '" . $id . "'");

        echo 1;
    }
} else {
    echo "Error";
}
