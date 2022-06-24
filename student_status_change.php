<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    $admin = $_POST["sid"];

    //search details from students table
    $query = Database::search("SELECT * FROM `students` WHERE `id` = '" . $admin . "'");
    $nr = $query->num_rows;

    //if row count is eqauls to 1
    if ($nr == 1) {
        $data = $query->fetch_assoc();

        //if student status is equals to 1 
        if ($data["status_id"] == 1) {
            //update students

            Database::iud("UPDATE `students` SET `status_id`= '2' WHERE `id`='" . $admin . "'");

            echo 1;
        } else {
            //update students
            Database::iud("UPDATE `students` SET `status_id`= '1' WHERE `id`='" . $admin . "'");

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