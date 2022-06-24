<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["t"])) {

    $subject = $_POST["subject"];
    $grade = $_POST["grade"];
    $desc = $_POST["desc"];
    $start_date = $_POST["start_date"];
    $last_date = $_POST["last_date"];

    if ($subject == 0) {
        echo "Please select a subject";
    } else if ($grade == 0) {
        echo "Please select a grade";
    } else if (empty($desc)) {
        echo "Please add a description";
    } else if (empty($start_date)) {
        echo "Please add assignment duration";
    } else if (empty($last_date)) {
        echo "Please add assignment duration";
    } else {
        //search details of assigned subject 

        $check = Database::search("SELECT * FROM `assigned_subject` WHERE `teachers_id` ='" . $_SESSION["t"]["id"] . "' AND `subject_id` = '" . $subject . "' AND `grade_id` = '" . $grade . "'");
        $c_num = $check->num_rows;

        if ($c_num == 1) {
            $allowed_file_extension = array("application/msword", "application/pdf");
            //check is there any uploaded file
            if (isset($_FILES["file"])) {

                //file assign
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

                        echo "Please select a file to upload";
                    } else {

                        //move upload file

                        move_uploaded_file($_FILES["file"]["tmp_name"], "doc/assignments/" . $fileName);

                        //insert into database

                        Database::iud("INSERT INTO `added_assignment` (`subject_id`,`grade_id`,`teachers_id`,`description`,`path`,`start_date`,`last_date`) VALUES ('" . $subject . "','" . $grade . "','" . $_SESSION["t"]["id"] . "','" . $desc . "','" . $fileName . "','" . $start_date . "','" . $last_date . "')");

                        echo 1;
                    }
                }
            } else {
                echo "Please select a file to upload";
            }
        } else {
            echo "Not assigned subject and grade";
        }
    }
}
