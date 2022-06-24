<?php
    session_start();

    require "connection.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember = $_POST["remember"];

//search admin 

    $rs = Database::search("SELECT * FROM `admin` WHERE `username`='".$username."' AND `admin_password`='".$password."' AND `status_id` = '1'");
    $n = $rs->num_rows;

    $blk = Database::search("SELECT * FROM `admin` WHERE `username`='".$username."' AND `admin_password`='".$password."' AND `status_id` = '2'");
    $bs = $blk->num_rows;

    if($n==1){ //Sign in Success 
        echo "Success";

        //assign all data to session
        $data = $rs->fetch_assoc();
        $_SESSION["a"] = $data;

        if($remember=="true"){ //when remember me is true 
            setcookie("u",$username,time()+(60*60*24*365));
            setcookie("p",$password,time()+(60*60*24*365));
        }else{//when remember me is false
            setcookie("u","",-1);
            setcookie("p","",-1);
        }
    }else if($bs==1){
        echo "You have been blocked";
    }else{
        echo "Invalid Details";
    }
