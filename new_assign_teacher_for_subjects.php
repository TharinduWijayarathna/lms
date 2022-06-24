<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
    //set time zone
    date_default_timezone_set('Asia/Colombo');
?>
    <!DOCTYPE html>
    <html lang="en">


    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
                                    <a class="btn btn-primary" href="index.php"><i class="ti-home mr-2"></i>Back to home</a>
                                </div>
                            </div>
                            <?php

                            //search details from teachers table
                            $teacher = Database::search("SELECT * FROM `teachers` WHERE `status_id` = '1' AND `verification_id` = '1'");
                            $tnum = $teacher->num_rows;

                            //search all details from subejct table
                            $subject = Database::search("SELECT * FROM `subject`");
                            $snum = $subject->num_rows;

                            //search all details from grade table
                            $grade = Database::search("SELECT * FROM `grade`");
                            $gnum = $grade->num_rows;
                            ?>
                            <div class="row mt-2 ">
                                <div class="col-8 offset-2 pt-2 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Assign a teacher to a subject</h4>
                                            <h4 class="text-danger"></h4>
                                            <p class="card-description">
                                                Select and Submit
                                            </p>
                                            <div class="forms-sample">

                                                <div class="form-group">
                                                    <label for="tname">Teacher Name <span class="text-secondary">(Only Verified)</span></label>

                                                    <select class="form-control" style="color: black;" id="teacher_id">
                                                        <option disabled="disabled" selected="selected" value="0">Select Teacher</option>
                                                        <?php

                                                        for ($i = 0; $i < $tnum; $i++) {
                                                            $tdata = $teacher->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $tdata["id"] ?>"> <?php echo $tdata["first_name"] . " " . $tdata["last_name"] ?> </option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </div>


                                                <div class="form-group">
                                                    <label for="sname">Subject Name</label>

                                                    <select class="form-control" style="color: black;" id="subject_id">
                                                        <option disabled="disabled" selected="selected" value="0">Select Subject</option>
                                                        <?php

                                                        for ($i = 0; $i < $snum; $i++) {
                                                            $sdata = $subject->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $sdata["id"] ?>"> <?php echo $sdata["subject"] ?> </option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </div>

                                                <div class="form-group">
                                                    <label for="gname">Grade</label>

                                                    <select class="form-control" style="color: black;" id="grade_id">
                                                        <option disabled="disabled" selected="selected" value="0">Select Grade</option>
                                                        <?php

                                                        for ($i = 0; $i < $gnum; $i++) {
                                                            $gdata = $grade->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $gdata["id"] ?>"> <?php echo $gdata["grade"] ?> </option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </div>

                                                <button class="btn btn-info mr-2" onclick="assign_teacher();">Assign</button>




                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- partial:../../partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                                <a href="#" target="_blank">Tharindu Wijayarathna</a>
                                from JIAT. All rights reserved.</span>

                        </div>
                    </footer>
                    <!-- partial -->
                </div>
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