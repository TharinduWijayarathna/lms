<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["t"])) {

    $subject = $_POST["subject"];
    $grade = $_POST["grade"];
    $desc = $_POST["desc"];


    $allowed_file_extension = array("application/msword", "application/pdf");

    //search path from database

    $file = Database::search("SELECT `path` FROM `lesson_notes` WHERE `teachers_id`='" . $_SESSION["t"]["id"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "'");
    $filedata = $file->fetch_assoc();

    //check is there any uploaded file

    if (isset($_FILES["file"])) {

        //assign image
        $file_ex = $_FILES["file"]["type"];

        if (!in_array($file_ex, $allowed_file_extension)) {
            echo "Please Select A Valid Document.";
        } else {

            $new_file_extension;

            //check file type is supported or not
            if ($file_ex == "application/msword") {
                $new_file_extension = ".docx";
            } else if ($file_ex == "application/pdf") {
                $new_file_extension = ".pdf";
            }

            //generate file name

            $fileName = uniqid() . $new_file_extension;

            if (isset($filedata)) {

                //update database

                Database::iud("UPDATE `lesson_notes` SET `path`='" . $fileName . "' , `description` = '" . $desc . "' WHERE `teachers_id`='" . $_SESSION["t"]["id"] . "' AND `path`='" . $filedata["path"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "'");
                unlink("doc/lesson_notes/" . $filedata["path"]);

                //add new file
                move_uploaded_file($_FILES["file"]["tmp_name"], "doc/lesson_notes/" . $fileName);

                echo 1;
            }
        }
    } else {
        echo "Please select a document";
    }
}
