<?php
session_start();

require "connection.php";

//get text
$text = $_POST["text"];

//check session
if (isset($_SESSION["a"])) {

    //search details from teachers table
    $query = Database::search("SELECT * FROM `teachers` INNER JOIN `assigned_subject` ON `teachers`.`id` = `assigned_subject`.`teachers_id` WHERE `first_name` LIKE '%" . $text . "%' OR `last_name` =  '%" . $text . "%'");
    $nr = $query->num_rows;


    //if row count is not eqauls to 0
    if ($nr != 0) {
?>
        <tr class="text-center">
            <th>Teacher ID</th>
            <th>First Name</th>
            <th>Last Name</th>

            <th>Email</th>
            <th>Assigned Subject</th>
            <th>Assigned Grade</th>
            <th>Unassign</th>
        </tr>

        <?php


        while ($data = $query->fetch_assoc()) {

            //search details from subject table
            $subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $data["subject_id"] . "'");
            $subdata = $subject->fetch_assoc();

            //search details from grade table
            $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
            $gradedata = $grade->fetch_assoc();
        ?>
            <input type="text" id="subject_id<?php echo $data['teachers_id'] ?>" style="display: none;" value="<?php echo $data["subject_id"] ?>">
            <input type="text" id="grade_id<?php echo $data['teachers_id'] ?>" style="display: none;" value="<?php echo $data["grade_id"] ?>">
            <tr class="text-center">

                <td><?php echo $data["id"] ?></td>
                <td><?php echo $data["first_name"] ?></td>
                <td><?php echo $data["last_name"] ?></td>

                <td><?php echo $data["email"] ?></td>
                <td><?php echo $subdata["subject"] ?></td>
                <td><?php echo $gradedata["grade"] ?></td>
                <td><button class="btn  btn-inverse-danger" onclick="unassign_teachers(<?php echo $data['teachers_id'] ?>);">Unassign</button></td>

            </tr>

        <?php
        }
        ?>
    <?php
    } else {
    }
} else {
    ?>
    <script>
        window.location = "admin_login.php";
    </script>
<?php
}


?>