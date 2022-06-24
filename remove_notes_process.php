<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["t"])) {

    $subject = $_POST["subject"];
    $grade = $_POST["grade"];
    $teacher = $_POST["teacher"];

    //search note
    $notes = Database::search("SELECT * FROM `lesson_notes` WHERE `teachers_id`='" . $_SESSION["t"]["id"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "'");
    $notenum = $notes->num_rows;

    //is there any row
    if ($notenum == 1) {
        $notesdata = $notes->fetch_assoc();

        //delete note
        Database::iud("DELETE FROM `lesson_notes` WHERE `teachers_id`='" . $_SESSION["t"]["id"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "'");

        //remove file
        unlink("doc/lesson_notes/" . $notesdata["path"]);

        echo 1;
    } else {
        echo 2;
    }
}
