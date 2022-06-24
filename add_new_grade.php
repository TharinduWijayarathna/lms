<?php 
session_start();

require "connection.php";

$grade = $_POST["grade"];

//check session
if(isset($_SESSION["a"])){

    //if there is a value in $grade
    if(isset($grade)){
        
        //insert into grade table
        Database::iud("INSERT INTO `grade`(`grade`) VALUES ('".$grade."')");

        echo 1;
    }
}
?>