<?php
session_start();

require "connection.php";

//get student nic
$nic = $_POST["nic"];

//search details from students table
$students_search = Database::search("SELECT * FROM `students` WHERE `nic` LIKE '%" . $nic . "%'");
$ssdata = $students_search->fetch_assoc();

//if there any data in table
if (isset($ssdata)) {

    //search details from upload assignment table without repeating
    $unique = Database::search("SELECT DISTINCT `subject_id`,`grade_id`,`added_assignment_id` FROM `upload_assignment` WHERE `students_id` = '" . $ssdata["id"] . "'");
    $unum = $unique->num_rows;

    for ($x = 0; $x < $unum; $x++) {
        $udata = $unique->fetch_assoc();

        //search details from subject table
        $findsub = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $udata["subject_id"] . "'");
        $fsdata = $findsub->fetch_assoc();

        //search details from grade table
        $findgr = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $udata["grade_id"] . "'");
        $grdata = $findgr->fetch_assoc();

?>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bold"><?php echo $fsdata["subject"] ?> (<?php echo $grdata["grade"] ?>)</h5>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="col-2">Name</th>
                                    <th class="col-2">
                                        NIC
                                    </th>
                                    <th class="col-3">
                                        Description
                                    </th>
                                    <th class="col-2">
                                        Deadline
                                    </th>

                                    <th class="col-3">
                                        Marks
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //search details from added assignment table
                                $query = Database::search("SELECT * FROM `added_assignment` WHERE `id` = '" . $udata["added_assignment_id"] . "'");
                                $qnum = $query->num_rows;

                                for ($i = 0; $i < $qnum; $i++) {
                                    $data = $query->fetch_assoc();

                                    //search details from upload assignment table
                                    $added = Database::search("SELECT * FROM `upload_assignment` WHERE `added_assignment_id` = '" . $data["id"] . "'");
                                    $adata = $added->fetch_assoc();

                                    //search details from student result table
                                    $marks = Database::search("SELECT * FROM `student_results` WHERE `upload_assignment_id` = '" . $adata["id"] . "' AND `students_id` = '" . $adata["students_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `subject_id` = '" . $data["subject_id"] . "'");
                                    $markr = $marks->num_rows;

                                    //search details from student result table that officer relesed student results
                                    $officer = Database::search("SELECT * FROM `student_results` WHERE `upload_assignment_id` = '" . $adata["id"] . "' AND `students_id` = '" . $adata["students_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `subject_id` = '" . $data["subject_id"] . "' AND `officer_viewed_status_id` = '1'");
                                    $offir = $officer->num_rows;

                                    //search details from students table
                                    $student = Database::search("SELECT * FROM `students` WHERE `id` = '" . $adata["students_id"] . "'");
                                    $studdata = $student->fetch_assoc();

                                    if ($offir != 0) {
                                ?>
                                        <tr>
                                            <td><?php echo $studdata["first_name"] . " " . $studdata["last_name"] ?></td>
                                            <td>
                                                <?php echo $studdata["nic"] ?>
                                            </td>
                                            <td>
                                                <?php echo $data["description"] ?>
                                            </td>
                                            <td>
                                                <?php echo $data["last_date"] ?>
                                            </td>

                                            <td>
                                                <?php

                                                $mdata = $marks->fetch_assoc();
                                                ?>
                                                <label class="badge badge-outline-primary"><?php echo $mdata["result"] ?></label>

                                            </td>


                                        </tr>
                                    <?php
                                    }
                                    ?>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
} else {
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold"></h5>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="col-2">Name</th>
                                <th class="col-2">
                                    NIC
                                </th>
                                <th class="col-3">
                                    Description
                                </th>
                                <th class="col-2">
                                    Deadline
                                </th>

                                <th class="col-3">
                                    Marks
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td colspan="5"><label class="badge badge-outline-primary" style="font-size: 14px;">Sorry! There is no student same to that nic number</label></td>



                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
}

?>