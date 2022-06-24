<?php
session_start();

require "connection.php";
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

//check session
if (isset($_SESSION["o"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password2 = $_POST["password2"];
    $password = $_POST["password1"];
    $nic = $_POST["nic"];
    $grade = $_POST["grade"];
    $gender = $_POST["gender"];
    $status = 1;

    $gender_id = "";

    if ($gender == "Male") {
        $gender_id = 1;
    } else if ($gender == "Female") {
        $gender_id = 2;
    } else {
        $gender_id = 1;
    }

    //get date

    date_default_timezone_set('Asia/Colombo');
    $date = date('Y/m/d');

    //validation
    if (empty($fname)) {
        echo "Please enter your first name";
    } else if (strlen($fname) > 50) {
        echo "First name must be less than 50 characters";
    } else if (empty($lname)) {
        echo "Please enter your last name";
    } else if (strlen($lname) > 50) {
        echo "Last name must be less than 50 characters";
    } else if (empty($email)) {
        echo "Please enter your email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
    } else if (strlen($email) > 100) {
        echo "Email must be less than 100 characters";
    } else if (empty($gender)) {
        echo "Select Your Gender";
    } else if (empty($nic)) {
        echo "Username field is empty";
    } else if (empty($grade)) {
        echo "Select a grade";
    } else if (empty($password)) {
        echo "Please enter your password";
    } else if (strlen($password) < 5 || strlen($password) > 20) {
        echo "Password length must between 5 to 20";
    } else if ($password != $password2) {
        echo "Passowrds Does Not Match";
    } else {

        //generate unique code 
        $verification_code = uniqid();
        $verify_id = 2;

        //search from students

        $rs = Database::search("SELECT * FROM `students` WHERE `nic`='" . $nic . "'");

        if ($rs->num_rows == 0) {

            //send email
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tharinduwijayarathna8206@gmail.com';
            $mail->Password = 'bmyztxsusllwigmr';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('tharinduwijayarathna8206@gmail.com', 'Redox LMS');
            $mail->addReplyTo('tharinduwijayarathna8206@gmail.com', 'Redox LMS');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Redox LMS Account verification Code';
            $bodyContent = '<h2 style="color:red;">Your Verification Code: ' . $verification_code . '</h2> <br> <h2 style="color:red;">Your Username: ' . $nic . '</h2> <br> <h2 style="color:red;">Your Password: ' . $password . '</h2>';
            $bodyContent .= '<p>Redox LMS Verify Process.</p>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo "Verification code sending failed";
            } else {

                //insert into student table

                Database::iud("INSERT INTO `students`(`nic`,`first_name`,`last_name`,`email`,`gender_id`,`password`,`verification_code`,`registered_on`,`status_id`,`verification_id`,`grade_id`,`trial_or_paid_id`) VALUES ('" . $nic . "','" . $fname . "','" . $lname . "','" . $email . "','" . $gender_id . "','" . $password . "','" . $verification_code . "','" . $date . "','" . $status . "','" . $verify_id . "','" . $grade . "','1'); ");

                echo 1;
            }

            // echo "Verification email sent";
        } else {
            echo "Email address Already Exists";
        }
    }
} else {
    echo 2;
}
