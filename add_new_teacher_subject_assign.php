<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {


    $teacher_id = $_POST["teacher_id"];
    $grade_id = $_POST["grade_id"];
    $subject_id = $_POST["subject_id"];

    //search assigned subject

    $search = Database::search("SELECT * FROM `assigned_subject` WHERE `teachers_id` = '" . $teacher_id . "' AND `subject_id` = '" . $subject_id . "' AND `grade_id` = '" . $grade_id . "'");
    $num = $search->num_rows;

    if ($num == 1) {
        //already assigned
        echo 2;
    } else {

        //insert into assigned_subject table
        Database::iud("INSERT INTO `assigned_subject`(`teachers_id`,`subject_id`,`grade_id`) VALUES ('" . $teacher_id . "','" . $subject_id . "','" . $grade_id . "'); ");

        echo 1;
    }
} else {
    echo 3;
}
