<?php
session_start();

require "connection.php";

//check session 

if (isset($_SESSION["a"])) {

    //get data from post method

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password2 = $_POST["password2"];
    $password = $_POST["password1"];
    $username = $_POST["username"];
    $gender = $_POST["gender"];
    $status = 1;

    //check gender

    $gender_id = "";

    if ($gender == "Male") {
        $gender_id = 1;
    } else if ($gender == "Female") {
        $gender_id = 2;
    } else {
        $gender_id = 1;
    }

    //validations

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
    } else if (empty($username)) {
        echo "Username field is empty";
    } else if (empty($password)) {
        echo "Please enter your password";
    } else if (strlen($password) < 5 || strlen($password) > 20) {
        echo "Password length must between 5 to 20";
    } else if ($password != $password2) {
        echo "Passowrds Does Not Match";
    } else {

        //insert data into admin table

        Database::iud("INSERT INTO `admin`(`username`,`first_name`,`last_name`,`email`,`gender_id`,`admin_password`,`status_id`) VALUES ('" . $username . "','" . $fname . "','" . $lname . "','" . $email . "','" . $gender_id . "','" . $password . "','" . $status . "'); ");

        echo 1;
    }
} else {

    echo 2;
}
