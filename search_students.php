<?php
session_start();

require "connection.php";

//get text
$text = $_POST["text"];

//check session
if (isset($_SESSION["a"])) {

    //search from students table
    $query = Database::search("SELECT * FROM students WHERE `first_name` LIKE '%" . $text . "%' OR `last_name` =  '%" . $text . "%'");
    $nr = $query->num_rows;

    //if row count is not equals to 0
    if ($nr != 0) {
?>
        <tr class="text-center">

            <th>First Name</th>
            <th>Last Name</th>
            <th>NIC</th>

            <th>Email</th>
            <th>Grade</th>
            <th>Verification</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>

        <?php


        for ($i = 0; $i < $nr; $i++) {
            $data = $query->fetch_assoc();

            //search details from grade table
            $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
            $gdata = $grade->fetch_assoc();

            //search all details from grade table
            $allgrade = Database::search("SELECT * FROM `grade`");
            $allgradenum = $allgrade->num_rows;

        ?>
            <tr class="text-center">

                <td><?php echo $data["first_name"] ?></td>
                <td><?php echo $data["last_name"] ?></td>
                <td><?php echo $data["nic"] ?></td>

                <td><?php echo $data["email"] ?></td>
                <td>
                    <select class="form-control" id="grade<?php echo $data['id'] ?>" onchange="student_grade(<?php echo $data['id'] ?>);">
                        <option selected disabled><?php echo $gdata["grade"] ?></option>
                        <?php
                        for ($x = 0; $x < $allgradenum; $x++) {
                            $allgdata = $allgrade->fetch_assoc();

                        ?>
                            <option value="<?php echo $allgdata["id"] ?>"><?php echo $allgdata["grade"] ?></option>

                        <?php

                        }
                        ?>
                    </select>
                </td>
                <td>
                    <?php
                    if ($data["verification_id"] == 1) {
                    ?>
                        <label class="btn btn-inverse-success col-12"><i class="ti-check"></i></label>
                    <?php
                    } else {
                    ?>
                        <label class="btn btn-inverse-primary col-12"><i class="ti-close"></i></label>
                    <?php
                    }
                    ?>
                </td>

                <?php
                if ($data["status_id"] == 1) {
                ?>
                    <td><button class="btn btn-inverse-danger col-12" onclick="student_action(<?php echo $data['id'] ?>);" id="actionbtn<?php echo $data['id'] ?>"><i class="ti-close"></i></button></td>
                <?php
                } else {
                ?>
                    <td><button class="btn btn-inverse-success col-12" onclick="student_action(<?php echo $data['id'] ?>);" id="actionbtn<?php echo $data['id'] ?>"><i class="ti-check"></i></button></td>
                <?php
                }
                ?>

                <td><button class="btn btn-inverse-info col-12" onclick="delete_student(<?php echo $data['id'] ?>);"><i class="ti-trash"></i></button></td>

            </tr>

        <?php
        }
        ?>
    <?php
    } else {
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