<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["t"])) {

    $subject = $_POST["subject"];
    $grade = $_POST["grade"];
    $teacher = $_POST["teacher"];
    $desc = $_POST["desc"];
    $start_date = $_POST["start_date"];
    $last_date = $_POST["last_date"];

    $allowed_file_extension = array("application/msword", "application/pdf");

    //search assignment details

    $file = Database::search("SELECT * FROM `added_assignment` WHERE `teachers_id`='" . $_SESSION["t"]["id"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "'");
    $filedata = $file->fetch_assoc();

    //check is there any uploaded file
    if (isset($_FILES["file"])) {

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

                Database::iud("UPDATE `added_assignment` SET `description` = '" . $desc . "' , `path` = '" . $fileName . "' WHERE `id` = '" . $filedata["id"] . "'");
                unlink("doc/assignments/" . $filedata["path"]);

                //move uploaded file

                move_uploaded_file($_FILES["file"]["tmp_name"], "doc/assignments/" . $fileName);

                echo 1;
            }
        }
    } else {
        echo 2;
    }
}
