<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["s"])) {

    $assignment = $_POST["assignment"];

    //check is there any value
    if (isset($assignment)) {

        //search details from added assignment table
        $added_assignment = Database::search("SELECT * FROM `added_assignment` WHERE `id` = '" . $assignment . "'");
        $adata = $added_assignment->fetch_assoc();

        //assign data from added assignment table
        $grade = $adata["grade_id"];
        $subject = $adata["subject_id"];

        //acceptable file types
        $allowed_file_extension = array("application/msword", "application/pdf");

        //search details from upload assignment table 
        $file = Database::search("SELECT * FROM `upload_assignment` WHERE `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "' AND `students_id` = '" . $_SESSION["s"]["id"] . "' AND `added_assignment_id` = '" . $assignment . "'");
        $filedata = $file->fetch_assoc();


        //check is there any uploaded file
        if (isset($_FILES["file"])) {

            //file assign
            $file_ex = $_FILES["file"]["type"];

            //check array 
            if (!in_array($file_ex, $allowed_file_extension)) {
                echo "Please Select A Valid Document.";
            } else {

                $new_file_extension;

                //check file type
                if ($file_ex == "application/msword") {
                    $new_file_extension = ".docx";
                } else if ($file_ex == "application/pdf") {
                    $new_file_extension = ".pdf";
                }

                //generate name
                $fileName = uniqid() . $new_file_extension;

                //check file data
                if (isset($filedata)) {


                    //update upload assignment table
                    Database::iud("UPDATE `upload_assignment` SET `path`='" . $fileName . "' WHERE `id` = '" . $filedata["id"] . "' AND `subject_id`='" . $subject . "' AND `grade_id` ='" . $grade . "' AND `students_id` = '" . $_SESSION["s"]["id"] . "' AND `added_assignment_id` = '" . $assignment . "' AND `viewed_or_not_id` = '2'");

                    //remove old file
                    unlink("doc/answer_sheets/" . $filedata["path"]);

                    //add new file
                    move_uploaded_file($_FILES["file"]["tmp_name"], "doc/answer_sheets/" . $fileName);

                    echo 1;
                } else {

                    //add new file
                    move_uploaded_file($_FILES["file"]["tmp_name"], "doc/answer_sheets/" . $fileName);

                    //insert data into upload assignment table
                    Database::iud("INSERT INTO `upload_assignment` (`subject_id`,`grade_id`,`students_id`,`path`,`added_assignment_id`,`viewed_or_not_id`) VALUES ('" . $subject . "','" . $grade . "','" . $_SESSION["s"]["id"] . "','" . $fileName . "','" . $assignment . "','2')");

                    echo 1;
                }
            }
        } else {
            echo "Please select a document";
        }
    }
}
