<?php

session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $teacher = $_POST["tid"];

    //search teacher
    $query = Database::search("SELECT * FROM `teachers` WHERE `id` = '" . $teacher . "'");
    $nr = $query->num_rows;

    //if row count is equals to 1
    if ($nr == 1) {
        //delete teacher details

        Database::iud("DELETE FROM `teachers` WHERE `id` = '" . $teacher . "'");

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