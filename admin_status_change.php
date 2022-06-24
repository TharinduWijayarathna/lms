<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $admin = $_POST["adminid"];

    //search admin

    $query = Database::search("SELECT * FROM `admin` WHERE `id` = '" . $admin . "'");
    $nr = $query->num_rows;

    //is there any data
    if ($nr == 1) {
        $data = $query->fetch_assoc();

        if ($data["status_id"] == 1) {

            //update admin table

            Database::iud("UPDATE `admin` SET `status_id`= '2' WHERE `id`='" . $admin . "'");

            echo 1;
        } else {

            //update admin table

            Database::iud("UPDATE `admin` SET `status_id`= '1' WHERE `id`='" . $admin . "'");

            echo 2;
        }
    } else {
        echo "Action Failed";
    }
} else {
?>
    <script>
        window.location = "admin_login.php";
    </script>
<?php

}

?>