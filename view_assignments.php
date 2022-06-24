<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["s"])) {

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
                                    <a class="btn btn-primary" href="student_dashboard.php"><i class="ti-back-left mr-2"></i>Back to Dashboard</a>

                                </div>
                            </div>


                            <div class="card-body">
                                <h4 class="card-title">View & Download Assignments</h4>
                                <p class="card-description">
                                    Click download button to download your assignment
                                </p>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>

                                                <th>Subject</th>
                                                <th>Description</th>
                                                <th>File Name</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //search details from added assignment table
                                            $query = Database::search("SELECT * FROM `added_assignment` WHERE `grade_id` = '" . $_SESSION["s"]["grade_id"] . "'");
                                            $qnum = $query->num_rows;

                                            for ($i = 0; $i < $qnum; $i++) {
                                                $data = $query->fetch_assoc();

                                                //search details from subject table
                                                $subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $data["subject_id"] . "'");
                                                $subdata = $subject->fetch_assoc();

                                                //search details from grade table
                                                $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
                                                $gradedata = $grade->fetch_assoc();


                                            ?>
                                                <tr>

                                                    <td><?php echo $subdata["subject"] ?></td>

                                                    <input type="text" disabled value="<?php echo $data["subject_id"] ?>" style="display: none;">
                                                    <input type="text" disabled value="<?php echo $data["grade_id"] ?>" style="display: none;">


                                                    <td> <label class="form-check-label"><?php echo $data["description"] ?></label></td>

                                                    <td><label class="form-check-label"><?php echo $data["path"] ?></label></td>


                                                    <td><a class="btn btn-inverse-success" href="doc/lesson_notes/<?php echo $data["path"] ?>">Download</a></td>





                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
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