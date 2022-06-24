<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $admin = $_POST["aid"];

    //search academic officers

    $query = Database::search("SELECT * FROM `academic_officers` WHERE `id` = '" . $admin . "'");
    $nr = $query->num_rows;

    //check is there any row
    if ($nr == 1) {
        $data = $query->fetch_assoc();

        //if value is equals to 1
        if ($data["status_id"] == 1) {

            //update academic officers

            Database::iud("UPDATE `academic_officers` SET `status_id`= '2' WHERE `id`='" . $admin . "'");

            echo 1;
        } else {
            //update academic officers

            Database::iud("UPDATE `academic_officers` SET `status_id`= '1' WHERE `id`='" . $admin . "'");

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