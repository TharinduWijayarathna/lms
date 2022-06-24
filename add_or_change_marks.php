<?php

session_start();

require "connection.php";

$id = $_POST["id"];
$marks = $_POST["marks"];

//check is there any data in $id variable
if (isset($id)) {

    //search assignment
    $assi = Database::search("SELECT * FROM `upload_assignment` WHERE `id` = '" . $id . "'");
    $asnum = $assi->num_rows;

    //is there any result
    if ($asnum == 1) {
        $asdata = $assi->fetch_assoc();

        //search data from student_results table
        $search_res = Database::search("SELECT * FROM `student_results` WHERE `upload_assignment_id` = '" . $asdata["id"] . "' AND `students_id` = '" . $asdata["students_id"] . "' AND `subject_id` = '" . $asdata["subject_id"] . "' AND `grade_id` = '" . $asdata["grade_id"] . "'");
        $srows = $search_res->num_rows;

        if ($srows == 1) {
            $sadata = $search_res->fetch_assoc();

            //update student results table

            Database::iud("UPDATE `student_results` SET `result` = '" . $marks . "' WHERE `id` = '" . $sadata["id"] . "'");

            echo 1;
        } else {

            //insert into student result table
            Database::iud("INSERT INTO `student_results`(`upload_assignment_id`,`students_id`,`subject_id`,`grade_id`,`result`,`officer_viewed_status_id`) VALUES ('" . $asdata["id"] . "','" . $asdata["students_id"] . "','" . $asdata["subject_id"] . "','" . $asdata["grade_id"] . "','" . $marks . "','2')");

            echo 1;
        }
    }
}
