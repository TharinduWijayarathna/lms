<?php 
session_start();

require "connection.php";

$subject = $_POST["subject"];

//check session
if(isset($_SESSION["a"])){

    //if there is a value in $grade
    if(isset($subject)){
        
        //insert into subject table
        Database::iud("INSERT INTO `subject`(`subject`) VALUES ('".$subject."')");

        echo 1;
    }
}
