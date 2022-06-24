<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["t"])) {

    $subject = $_POST["subject"];
    $grade = $_POST["grade"];
    $teacher = $_POST["teacher"];

    //search assignment

    $assignmets = Database::search("SELECT * FROM `added_assignment` WHERE `teachers_id`='" . $_SESSION["t"]["id"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "'");
    $assignmetsnum = $assignmets->num_rows;

    //is there any row
    if ($assignmetsnum == 1) {
        $assignmetsdata = $assignmets->fetch_assoc();

        //delete assignments

        Database::iud("DELETE FROM `added_assignment` WHERE `teachers_id`='" . $_SESSION["t"]["id"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "'");

        //remove file
        unlink("doc/assignments/" . $assignmetsdata["path"]);

        echo 1;
    } else {
        echo 2;
    }
}
