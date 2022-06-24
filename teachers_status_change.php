<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $admin = $_POST["tid"];

    //search details from teachers table
    $query = Database::search("SELECT * FROM `teachers` WHERE `id` = '" . $admin . "'");
    $nr = $query->num_rows;

    //if row count is equals to 1
    if ($nr == 1) {
        $data = $query->fetch_assoc();

        //if status id equals to 1
        if ($data["status_id"] == 1) {
            //update teachers table
            Database::iud("UPDATE `teachers` SET `status_id`= '2' WHERE `id`='" . $admin . "'");

            echo 1;
        } else {
            //update teachers table
            Database::iud("UPDATE `teachers` SET `status_id`= '1' WHERE `id`='" . $admin . "'");

            echo 2;
        }
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