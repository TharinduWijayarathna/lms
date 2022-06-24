<?php

session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $officer = $_POST["aid"];

    //search officer 

    $query = Database::search("SELECT * FROM `academic_officers` WHERE `id` = '" . $officer . "'");
    $nr = $query->num_rows;

    //if row count is equals to 1
    if ($nr == 1) {

        //delete officer
        Database::iud("DELETE FROM `academic_officers` WHERE `id` = '" . $officer . "'");

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