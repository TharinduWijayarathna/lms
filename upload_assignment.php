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
                                <h4 class="card-title">Submit Your Assignments</h4>
                                <p class="card-description">
                                    Click upload button to upload your assignment
                                </p>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>

                                                <th>Subject</th>
                                                <th>Description</th>
                                                <th>File Name</th>
                                                <th>Upload / Reupload</th>
                                                <th>Confirm</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //check details from added assignment table
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

                                                //search details from upload assignment table
                                                $submit_status = Database::search("SELECT * FROM `upload_assignment` WHERE `added_assignment_id` = '" . $data["id"] . "' AND `subject_id` = '" . $data["subject_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `students_id` = '" . $_SESSION["s"]["id"] . "'");
                                                $sstatus = $submit_status->num_rows;

                                            ?>
                                                <tr>

                                                    <td><?php echo $subdata["subject"] ?></td>

                                                    <input type="text" disabled value="<?php echo $data["subject_id"] ?>" style="display: none;">
                                                    <input type="text" disabled value="<?php echo $data["grade_id"] ?>" style="display: none;">


                                                    <td> <label class="form-check-label"><?php echo $data["description"] ?></label></td>

                                                    <?php
                                                    if ($sstatus == 1) {
                                                    ?>
                                                        <td><label class="badge badge-info">Submitted</label></td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td><label class="badge badge-warning">Not Uploaded</label></td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <td>
                                                        <input type="file" style="display: none;" accept=".pdf ,.doc ,.docx" id="answer<?php echo $data["id"] ?>" />
                                                        <label for="answer<?php echo $data["id"] ?>" class="btn btn-outline-info btn-icon-text"><i class="ti-upload"></i></label>
                                                    </td>
                                                    <td>
                                                        <button id="upload<?php echo $data["id"] ?>" style="display: none;"></button>
                                                        <label for="upload<?php echo $data["id"] ?>" class="btn btn-outline-dark" onclick="upload_answer(<?php echo $data['id'] ?>);"><i class="ti-check btn-icon-prepend"></i></label>
                                                    </td>







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