<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password2 = $_POST["password2"];
    $password = $_POST["password1"];
    $username = $_POST["username"];
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

        //acceptable image types
        $allowed_image_extension = array("image/jpeg", "image/jpg", "image/png", "image/svg", "image/svg+xml");

        //search image path from admin img table 
        $img = Database::search("SELECT `path` FROM `admin_img` WHERE `admin_id`='" . $_SESSION["a"]["id"] . "'");
        $imgdata = $img->fetch_assoc();


        //check if there is any uploaded file 
        if (isset($_FILES["img"])) {

            //image assign
            $file_ex = $_FILES["img"]["type"];

            if (!in_array($file_ex, $allowed_image_extension)) {
                echo "Please Select A Valid Image.";
            } else {

                $new_img_extension;

                //check image is acceptable 
                if ($file_ex == "image/jpeg") {
                    $new_img_extension = ".jpeg";
                } else if ($file_ex == "image/jpg") {
                    $new_img_extension = ".jpg";
                } else if ($file_ex == "image/png") {
                    $new_img_extension = ".png";
                } else if ($file_ex == "image/svg" || $file_ex == "image/svg+xml") {
                    $new_img_extension = ".svg";
                }

                //generate unique id
                $fileName = uniqid() . $new_img_extension;

                //check image data
                if (isset($imgdata)) {

                    //update admin img table
                    Database::iud("UPDATE `admin_img` SET `path`='" . $fileName . "' WHERE `admin_id`='" . $_SESSION["a"]["id"] . "' AND `path`='" . $imgdata["path"] . "'");

                    //remove image
                    unlink("images/admin_profiles/" . $imgdata["path"]);

                    //add new image
                    move_uploaded_file($_FILES["img"]["tmp_name"], "images/admin_profiles/" . $fileName);

                    //update admin table
                    Database::iud("UPDATE `admin` SET `username` = '" . $username . "',`first_name` = '" . $fname . "',`last_name`='" . $lname . "',`email`='" . $email . "',`gender_id`='" . $gender_id . "',`admin_password`='" . $password . "',`status_id`='" . $status . "' WHERE `id` ='" . $_SESSION["a"]["id"] . "'");

                    echo 1;
                } else {

                    //add new image
                    move_uploaded_file($_FILES["img"]["tmp_name"], "images/admin_profiles/" . $fileName);

                    //insert data into admin img table
                    Database::iud("INSERT INTO `admin_img` (`admin_id`,`path`) VALUES ('" . $_SESSION["a"]["id"] . "','" . $fileName . "')");

                    //update admin table
                    Database::iud("UPDATE `admin` SET `username` = '" . $username . "',`first_name` = '" . $fname . "',`last_name`='" . $lname . "',`email`='" . $email . "',`gender_id`='" . $gender_id . "',`admin_password`='" . $password . "',`status_id`='" . $status . "' WHERE `id` ='" . $_SESSION["a"]["id"] . "'");

                    echo 1;
                }
            }
        } else {

            //update admin table
            Database::iud("UPDATE `admin` SET `username` = '" . $username . "',`first_name` = '" . $fname . "',`last_name`='" . $lname . "',`email`='" . $email . "',`gender_id`='" . $gender_id . "',`admin_password`='" . $password . "',`status_id`='" . $status . "' WHERE `id` ='" . $_SESSION["a"]["id"] . "'");

            echo 1;
        }
    }
} else {

    echo 2;
}
