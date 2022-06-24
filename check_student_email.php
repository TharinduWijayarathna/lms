<?php
require "connection.php";
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

//check is there any value on $_POST["email"]
if (isset($_POST["email"])) {

    //assign value to $e
    $e = $_POST["email"];

    //if $e is empty
    if (empty($e)) {

        echo "Please enter your email address";

        //else $e have value
    } else {

        //search details from students table
        $rs = Database::search("SELECT * FROM `students` WHERE `email`='" . $e . "'");

        //if is there any row
        if ($rs->num_rows == 1) {

            //generate code
            $code = uniqid();

            //update students table
            Database::iud("UPDATE `students` SET `verification_code`='" . $code . "' WHERE `email`='" . $e . "'");

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
            $mail->addAddress($e);
            $mail->isHTML(true);
            $mail->Subject = 'Redox LMS Account verification Code';
            $bodyContent = '<h1 style="color:red;">Your Verification Code: ' . $code . '</h1>';
            $bodyContent .= '<p>Redox LMS Verify Process.</p>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo "Verification code sending failed";
            } else {
                echo 1;
            }


            // echo "Verification email sent";
        } else {
            echo "Email address not found";
        }
    }
} else {
    echo "Please enter your email address";
}
