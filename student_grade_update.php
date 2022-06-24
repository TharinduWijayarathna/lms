<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $grade_id = $_POST["grade"];
    $student_id = $_POST["id"];

    //search details from students table
    $student = Database::search("SELECT * FROM `students` WHERE `id` = '" . $student_id . "'");
    $snum = $student->num_rows;

    //if row count is equals to 1
    if ($snum == 1) {
        //update students table
        Database::iud("UPDATE `students` SET `grade_id` = '" . $grade_id . "' WHERE `id`= '" . $student_id . "'");

        echo 1;
    }
}
