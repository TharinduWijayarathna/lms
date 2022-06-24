<?php

session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $admin = $_POST["adminid"];

    //search admin details
    $query = Database::search("SELECT * FROM `admin` WHERE `id` = '" . $admin . "'");
    $nr = $query->num_rows;

    //if row count is equals to 1
    if ($nr == 1) {
        //delte admin

        Database::iud("DELETE FROM `admin` WHERE `id` = '" . $admin . "'");

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