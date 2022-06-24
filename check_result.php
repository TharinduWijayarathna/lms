<?php
session_start();

require "connection.php";

if (isset($_SESSION["a"])) {

    date_default_timezone_set('Asia/Colombo');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>JIAT LMS</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/feather/feather.css" />
        <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
        <!-- endinject -->

        <!-- inject:css -->
        <link rel="stylesheet" href="css/vertical-layout-light/style.css" />
        <!-- endinject -->
        <link rel="shortcut icon" href="images/logo-mini.svg" />
    </head>

    <body>
        <div class=" container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="main-panel w-100  documentation">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 pt-5">
                                    <a class="btn btn-primary" href="admin_dashboard.php"><i class="ti-back-left mr-2"></i>Back to Dashboard</a>
                                </div>
                            </div>
                            <div class="mb-4 mt-4">
                                <h4 class="font-weight-bold">Check Results</h4>
                                <h5>You can check released marks using student nic</h5>
                            </div>

                            <div class="input-group col-5" style="margin-left: 20px;">
                                <input type="text" class="form-control" placeholder="Student NIC" id="nic" aria-label="Student NIC">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="search_result();"><i class="ti-search"></i></button>
                                </div>
                            </div>

                            <div id="dataload">

                                <?php
                                //search details from upload_assignment table without repeating
                                $unique = Database::search("SELECT DISTINCT `subject_id`,`grade_id`,`added_assignment_id` FROM `upload_assignment`");
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
                                                            //search details from added_assignment table 
                                                            $query = Database::search("SELECT * FROM `added_assignment` WHERE `id` = '" . $udata["added_assignment_id"] . "'");
                                                            $qnum = $query->num_rows;

                                                            for ($i = 0; $i < $qnum; $i++) {
                                                                $data = $query->fetch_assoc();

                                                                //serach details from upload_assignment table
                                                                $added = Database::search("SELECT * FROM `upload_assignment` WHERE `added_assignment_id` = '" . $data["id"] . "'");
                                                                $adata = $added->fetch_assoc();

                                                                //search details from student_results table
                                                                $marks = Database::search("SELECT * FROM `student_results` WHERE `upload_assignment_id` = '" . $adata["id"] . "' AND `students_id` = '" . $adata["students_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `subject_id` = '" . $data["subject_id"] . "'");
                                                                $markr = $marks->num_rows;

                                                                //search details from student_results that officer released their marks
                                                                $officer = Database::search("SELECT * FROM `student_results` WHERE `upload_assignment_id` = '" . $adata["id"] . "' AND `students_id` = '" . $adata["students_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `subject_id` = '" . $data["subject_id"] . "' AND `officer_viewed_status_id` = '1'");
                                                                $offir = $officer->num_rows;

                                                                //search details from student table
                                                                $student = Database::search("SELECT * FROM `students` WHERE `id` = '" . $adata["students_id"] . "'");
                                                                $studdata = $student->fetch_assoc();

                                                                //if it is not equal to 0
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
                                ?>
                            </div>

                        </div>

                    </div>
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                                <a href="#" target="_blank">Tharindu Wijayarathna</a>
                                from JIAT. All rights reserved.</span>

                        </div>
                    </footer>
                </div>
            </div>


            <!-- plugins:js -->
            <script src="vendors/js/vendor.bundle.base.js"></script>
            <!-- endinject -->

            <!-- inject:js -->
            <script src="js/template.js"></script>

            <script src="js/script.js"></script>
    </body>

    </html>

<?php
} else {
?>
    <script>
        window.location = "admin_login.php";
    </script>

<?php
}
?>