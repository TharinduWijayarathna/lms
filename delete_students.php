<?php

session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $student = $_POST["sid"];
    //search students details

    $query = Database::search("SELECT * FROM `students` WHERE `id` = '" . $student . "'");
    $nr = $query->num_rows;

    //if is there any row
    if ($nr == 1) {

        //delete students

        Database::iud("DELETE FROM `students` WHERE `id` = '" . $student . "'");

        echo 1;
    } else {
        echo "Action Failed";
    }
} else {
    //redirect
?>
    <script>
        window.location = "admin_login.php";
    </script>
<?php
}

?>