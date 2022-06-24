<?php
require "connection.php";
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

//check $_POST["email"] value
if (isset($_POST["email"])) {

    //assign value to $e
    $e = $_POST["email"];

    //if $e is empty
    if (empty($e)) {

        echo "Please enter your email address";

    //not empty    
    } else {

        //search detauks from admin table
        $rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $e . "'");

        //is there any row
        if ($rs->num_rows == 1) {

            //generate code
            $code = uniqid();

            //update admin table
            Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $e . "'");

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
