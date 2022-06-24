<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["t"])) {

    //time zone
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
                                    <a class="btn btn-primary" href="teacher_dashboard.php"><i class="ti-back-left mr-2"></i>Back to Dashboard</a>

                                </div>
                            </div>


                            <div class="card-body">
                                <h4 class="card-title">Submitted Answer Sheets</h4>
                                <p class="card-description">
                                    Click download button to download answer sheet
                                </p>

                                <?php
                                //search details from upload assignment table without repeating 
                                $unique = Database::search("SELECT DISTINCT `subject_id`,`grade_id`,`added_assignment_id`,`id` FROM `upload_assignment`");
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
                                    <h5 class="mt-4"><?php echo $fsdata["subject"] ?> (<?php echo $grdata["grade"] ?>)</h5>
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>


                                                    <th class="col-3">Description</th>
                                                    <th class="col-2">Student NIC</th>
                                                    <th class="col-2">Download</th>
                                                    <th class="col-2">Status</th>
                                                    <th class="col-3">Viewed or Not</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //search details from upload assignment table
                                                $query = Database::search("SELECT * FROM `upload_assignment` WHERE `grade_id` = '" . $udata["grade_id"] . "' AND `subject_id` = '" . $udata["subject_id"] . "' AND `added_assignment_id` = '" . $udata["added_assignment_id"] . "'");
                                                $qnum = $query->num_rows;

                                                for ($i = 0; $i < $qnum; $i++) {
                                                    $data = $query->fetch_assoc();

                                                    //search details from added assignment table
                                                    $added = Database::search("SELECT * FROM `added_assignment` WHERE `id` = '" . $data["added_assignment_id"] . "'");
                                                    $adata = $added->fetch_assoc();

                                                    //search details from students table
                                                    $student = Database::search("SELECT `nic` FROM `students` WHERE `id` = '" . $data["students_id"] . "'");
                                                    $sdata = $student->fetch_assoc();

                                                    //search details from grade table
                                                    $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
                                                    $gradedata = $grade->fetch_assoc();

                                                ?>
                                                    <tr>





                                                        <td> <label class="form-check-label"><?php echo $adata["description"] ?></label></td>

                                                        <td><label class="form-check-label"><?php echo $sdata["nic"] ?></label></td>


                                                        <td><a class="btn btn-inverse-success" href="doc/answer_sheets/<?php echo $data["path"] ?>" download>Download</a></td>
                                                        <?php
                                                        if ($data["viewed_or_not_id"] == 1) {
                                                        ?>
                                                            <td><label class="badge badge-success">Viewed</label></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td><label class="badge badge-danger">Not Viewed</label></td>
                                                        <?php
                                                        }
                                                        ?>

                                                        <td><button class="btn btn-outline-info" onclick="viewed_status(<?php echo $data['id'] ?>);"><i class="ti-check"></i></button>
                                                            <button class="btn btn-outline-danger" onclick="not_viewed_status(<?php echo $data['id'] ?>);"><i class="ti-close"></i></button>
                                                        </td>



                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
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
    //redirect
?>
    <script>
        window.location = "teacher_login.php";
    </script>

<?php
}
?>