<?php
    session_start();

    require "connection.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember = $_POST["remember"];

    //search active teachers details from teachers table
    $rs = Database::search("SELECT * FROM `teachers` WHERE `username`='".$username."' AND `password`='".$password."' AND `status_id` = '1'");
    $n = $rs->num_rows;

    //search blocked teachers details from teachers table
    $blk = Database::search("SELECT * FROM `teachers` WHERE `username`='".$username."' AND `password`='".$password."' AND `status_id` = '2'");
    $bs = $blk->num_rows;

    //if row count is equals to 1
    if($n==1){ //Sign in Success 

        //search teacher verfied details from teachers table
        $verified = Database::search("SELECT * FROM `teachers` WHERE `username`='".$username."' AND `password`='".$password."' AND `status_id` = '1' AND `verification_id` = '1'");
        $verification_done = $verified->num_rows;

        //if row count is equals to 1
        if($verification_done == 1){
            
            //assign data to a session
            $data = $rs->fetch_assoc();
            $_SESSION["t"] = $data;
    
            //set cookie
            if($remember=="true"){ //when remember me is true 
                setcookie("tu",$username,time()+(60*60*24*365));
                setcookie("tp",$password,time()+(60*60*24*365));
            }else{//when remember me is false
                setcookie("tu","",-1);
                setcookie("tp","",-1);
            }

            echo "Success";
        }else{
            echo 1;
        }

        //if blocked
    }else if($bs==1){
        echo "You have been blocked";
    }else{
        echo "Invalid Details";
    }
