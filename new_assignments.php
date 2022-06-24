<?php
session_start();

require "connection.php";

if (isset($_SESSION["t"])) {

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
                                    <a class="btn btn-primary" href="add_new_assignments.php"><i class="ti-back-left mr-2"></i>Back to Add Assginments</a>

                                </div>
                            </div>

                            <div class="col-12 mt-2 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add New Assignmnet</h4>
                                        <p class="text-dark">
                                            You can add new assignments to the portal and you can update or remove them using the previous page
                                        </p>
                                        <div class="form-sample">
                                            <p class="card-description">
                                                Select the subject and grade assgined to you
                                            </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Subject</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" id="subid">
                                                                <option value="0">Select Subject</option>

                                                                <?php
                                                                //search subject_id from assigned_subject without repeating 
                                                                $tdata = Database::search("SELECT DISTINCT `subject_id` FROM `assigned_subject` WHERE `teachers_id` = '" . $_SESSION["t"]["id"] . "'");
                                                                $tnum = $tdata->num_rows;

                                                                for ($i = 0; $i < $tnum; $i++) {
                                                                    $tfetch = $tdata->fetch_assoc();

                                                                    //search details from subejct table
                                                                    $subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $tfetch["subject_id"] . "'");
                                                                    $subdata = $subject->fetch_assoc();

                                                                ?>
                                                                    <option value="<?php echo $subdata["id"] ?>"><?php echo $subdata["subject"] ?></option>
                                                                <?php
                                                                }
                                                                ?>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Grade</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" id="gradeid">
                                                                <option value="0">Select Grade</option>

                                                                <?php
                                                                //search grade_id from assigned_subject without repeating 
                                                                $tdata1 = Database::search("SELECT DISTINCT `grade_id` FROM `assigned_subject` WHERE `teachers_id` = '" . $_SESSION["t"]["id"] . "'");
                                                                $tnum1 = $tdata1->num_rows;

                                                                for ($i = 0; $i < $tnum1; $i++) {
                                                                    $tfetch1 = $tdata1->fetch_assoc();
                                                                    //search details from grade table
                                                                    $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $tfetch1["grade_id"] . "'");
                                                                    $gradedata = $grade->fetch_assoc();

                                                                ?>
                                                                    <option value="<?php echo $gradedata["id"] ?>"><?php echo $gradedata["grade"] ?></option>
                                                                <?php
                                                                }
                                                                ?>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <p class="card-description">
                                                Add small description about assignment
                                            </p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Assignment Description</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="desc" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <p class="card-description">
                                                Add assignment duration
                                            </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Start Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" class="form-control" id="startdate" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Last Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" class="form-control" id="lastdate" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="card-description">
                                                Upload Assignment File
                                            </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Assignment</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" style="display: none;" accept=".pdf ,.doc ,.docx" id="notes" />
                                                            <label for="notes" class="btn btn-outline-danger btn-icon-text"><i class="ti-upload btn-icon-prepend"></i> Upload </label>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-6 mt-4 offset-3">
                                                    <button class="btn btn-inverse-primary col-12" onclick="add_new_assignmets()">Add Assignment</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
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
        window.location = "teacher_login.php";
    </script>

<?php
}
?>