<?php

session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $teacher_id = $_POST["teacher_id"];
    $grade_id = $_POST["grade_id"];
    $subject_id = $_POST["subject_id"];

    //search details from assigned subject table
    $query = Database::search("SELECT * FROM `assigned_subject` WHERE `teachers_id` = '" . $teacher_id . "' AND `grade_id` = '" . $grade_id . "' AND `subject_id` = '" . $subject_id . "'");
    $nr = $query->num_rows;

    //if row count is equals to 1
    if ($nr == 1) {

        //delete details from assigned subject table
        Database::iud("DELETE FROM `assigned_subject` WHERE `teachers_id` = '" . $teacher_id . "' AND `grade_id` = '" . $grade_id . "' AND `subject_id` = '" . $subject_id . "'");

        echo 1;
    } else {
        echo "Action Failed";
    }
} else {
    //redirect
?>
    <script>
        window.location = "admin_login.php";
    </script>
<?php
}

?>