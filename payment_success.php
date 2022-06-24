<?php
session_start();

//time zone
date_default_timezone_set('Asia/Colombo');

require "connection.php";

//check session
if (isset($_SESSION["pd"])) {

    //get student detals

    $search = Database::search("SELECT * FROM `students` WHERE `id` = '" . $_SESSION["pd"]["id"] . "' AND `nic` = '" . $_SESSION["pd"]["nic"] . "' AND `email` = '" . $_SESSION["pd"]["email"] . "'");
    $snum = $search->num_rows;

    //if there is any row
    if ($snum == 1) {
        $sdata = $search->fetch_assoc();

        //today date
        $date = date("Y-m-d");
        //update students table

        Database::iud("UPDATE `students` SET `trial_or_paid_id` = '2' WHERE `id` = '" . $_SESSION["pd"]["id"] . "'");

        //insert into payment data table
        Database::iud("INSERT INTO `payment_data`(`students_id`,`date`) VALUES ('" . $_SESSION["pd"]["id"] . "','" . $date . "')");

        //redirect
?>
        <script>
            window.location = "student_login.php";
        </script>
<?php
    }
}
