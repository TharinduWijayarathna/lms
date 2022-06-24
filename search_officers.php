<?php
session_start();

require "connection.php";

//get text
$text = $_POST["text"];

//check session
if (isset($_SESSION["a"])) {

    //search details from academic_officers table
    $query = Database::search("SELECT * FROM academic_officers WHERE `first_name` LIKE '%" . $text . "%' OR `last_name` =  '%" . $text . "%'");
    $nr = $query->num_rows;

    //if row count is not equals to 0
    if ($nr != 0) {
?>
        <tr class="text-center">
            <th>Officer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Verification</th>
            <th>Change Status</th>
            <th>Delete</th>
        </tr>

        <?php


        while ($data = $query->fetch_assoc()) {

        ?>
            <tr class="text-center">
                <td><?php echo $data["id"] ?></td>
                <td><?php echo $data["first_name"] ?></td>
                <td><?php echo $data["last_name"] ?></td>
                <td><?php echo $data["username"] ?></td>
                <td><?php echo $data["email"] ?></td>
                <td>
                    <?php
                    //if officer verification id equals to 1
                    if ($data["verification_id"] == 1) {
                    ?>
                        <label class="btn btn-inverse-success col-12">Verified</label>
                    <?php
                    } else {
                    ?>
                        <label class="btn btn-inverse-primary col-12">Not Verified</label>
                    <?php
                    }
                    ?>
                </td>

                <?php
                if ($data["status_id"] == 1) {
                ?>
                    <td><button class="btn btn-inverse-danger col-12" onclick="officer_action(<?php echo $data['id'] ?>);" id="actionbtn<?php echo $data['id'] ?>">Deactive</button></td>
                <?php
                } else {
                ?>
                    <td><button class="btn btn-inverse-success col-12" onclick="officer_action(<?php echo $data['id'] ?>);" id="actionbtn<?php echo $data['id'] ?>">Active</button></td>
                <?php
                }
                ?>

                <td><button class="btn btn-inverse-info col-12" onclick="delete_officer(<?php echo $data['id'] ?>);">Delete</button></td>

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