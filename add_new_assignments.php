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
                                    <a href="new_assignments.php" class="btn btn-info"><i class="icon-plus"></i> &nbsp; Add Assignments</a>
                                </div>
                            </div>


                            <div class="card-body">
                                <h4 class="card-title">Add or Remove Assignments</h4>
                                <p class="card-description">
                                    Click confirm after doing updates
                                </p>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>

                                                <th>Subject</th>
                                                <th>Grade</th>
                                                <th>Description</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Add / Replace</th>
                                                <th>Confirm</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //search added assignment

                                            $query = Database::search("SELECT * FROM `added_assignment` WHERE `teachers_id` = '" . $_SESSION["t"]["id"] . "'");
                                            $qnum = $query->num_rows;

                                            for ($i = 0; $i < $qnum; $i++) {
                                                $data = $query->fetch_assoc();
                                                //search details from subject table 

                                                $subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $data["subject_id"] . "'");
                                                $subdata = $subject->fetch_assoc();

                                                //search details from grade table
                                                $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
                                                $gradedata = $grade->fetch_assoc();

                                                //search details from added_assignment table
                                                $assignment = Database::search("SELECT * FROM `added_assignment` WHERE `teachers_id` = '" . $data["teachers_id"] . "' AND `subject_id` = '" . $data["subject_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `id` = '" . $data["id"] . "'");
                                                $assignmentnum = $assignment->num_rows;
                                                $assignmentdata = $assignment->fetch_assoc();
                                            ?>
                                                <tr>

                                                    <td><?php echo $subdata["subject"] ?></td>
                                                    <td><?php echo $gradedata["grade"] ?></td>

                                                    <input type="text" disabled value="<?php echo $assignmentdata["subject_id"] ?>" style="display: none;" id="subid<?php echo $assignmentdata['id'] ?>">
                                                    <input type="text" disabled value="<?php echo $assignmentdata["grade_id"] ?>" style="display: none;" id="gradeid<?php echo $assignmentdata['id'] ?>">
                                                    <input type="text" disabled value="<?php echo $assignmentdata["teachers_id"] ?>" style="display: none;" id="teachersid<?php echo $assignmentdata['id'] ?>">

                                                    <?php

                                                    //assignment count is equals to 1
                                                    if ($assignmentnum == 1) {
                                                       
                                                    ?>

                                                        <td> <input class="form-control" type="text" value="<?php echo $assignmentdata["description"] ?>" id="desc<?php echo $assignmentdata["id"] ?>"></td>
                                                        <td><?php echo $assignmentdata["start_date"] ?></td>
                                                        <td><?php echo $assignmentdata["last_date"] ?></td>

                                                        <td><label class="btn btn-outline-success disabled" id="substatus<?php echo $assignmentdata["id"] ?>"><i class="ti-check btn-icon-prepend"></label></td>
                                                        <td>
                                                            <input type="file" style="display: none;" accept=".pdf ,.doc ,.docx" id="notes<?php echo $assignmentdata["id"] ?>" />
                                                            <label for="notes<?php echo $assignmentdata["id"] ?>" class="btn btn-outline-info btn-icon-text" onclick="changesubicon(<?php echo $assignmentdata['id'] ?>);"><i class="ti-upload"></i></label>
                                                        <td>
                                                            <button id="upload<?php echo $assignmentdata["id"] ?>" style="display: none;" onclick="dateload(<?php echo $assignmentdata['id'] ?>);"></button>
                                                            <label for="upload<?php echo $assignmentdata["id"] ?>" class="btn btn-outline-dark"><i class="ti-check btn-icon-prepend"></i></label>
                                                        </td>

                                                        </td>
                                                        <td>
                                                            <button style="display: none;" id="remove<?php echo $assignmentdata["id"] ?>" onclick="remove_assignment(<?php echo $assignmentdata['id'] ?>);"></button>
                                                            <label for="remove<?php echo $assignmentdata["id"] ?>" class="btn btn-outline-danger"><i class="ti-trash"></i></label>

                                                        </td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td> <input class="form-control" type="text" value="Empty" id="desc<?php echo $assignmentdata["id"] ?>"></td>
                                                        <td>
                                                            <h3 class="font-weight-bold" id="startdate<?php echo $assignmentdata["id"] ?>">-</h3>
                                                        </td>
                                                        <td>
                                                            <h3 class="font-weight-bold" id="lastdate<?php echo $assignmentdata["id"] ?>">-</h3>
                                                        </td>
                                                        <td><label class="btn btn-outline-danger disabled" id="substatus<?php echo $assignmentdata["id"] ?>"><i class="ti-close btn-icon-prepend"></label></td>
                                                        <td>

                                                            <input type="file" style="display: none;" accept=".pdf ,.doc ,.docx" id="notes<?php echo $assignmentdata["id"] ?>" />
                                                            <label for="notes<?php echo $assignmentdata["id"] ?>" class="btn btn-outline-info btn-icon-text" onclick="changesubicon(<?php echo $assignmentdata['id'] ?>);"><i class="ti-upload"></i></label>
                                                        <td>
                                                            <button id="upload<?php echo $assignmentdata["id"] ?>" style="display: none;" onclick="dateload(<?php echo $data['id'] ?>);"></button>
                                                            <label for="upload<?php echo $assignmentdata["id"] ?>" class="btn btn-outline-dark"><i class="ti-check btn-icon-prepend"></i></label>

                                                        </td>




                                                        </td>
                                                        <td>
                                                            <button style="display: none;" id="remove<?php echo $assignmentdata["id"] ?>" onclick="remove_assignment(<?php echo $assignmentdata['id'] ?>);"></button>
                                                            <label for="remove<?php echo $data["id"] ?>" class="btn btn-outline-danger"><i class="ti-trash"></i></label>

                                                        </td>
                                                    <?php
                                                    }
                                                    ?>


                                                </tr>
                                                <div class="modal fade" tabindex="-1" role="dialog" id="dateset<?php echo $data['id'] ?>">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Please set assignment duration</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Start Date</h6>

                                                                <input type="date" class="form-control" id="startdate<?php echo $data['id'] ?>">
                                                                <br>
                                                                <h6>Last Date</h6>

                                                                <input type="date" class="form-control" id="lastdate<?php echo $data['id'] ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-inverse-danger" data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-inverse-success" data-dismiss="modal" onclick="assignmets(<?php echo $assignmentdata['id'] ?>)">Add Assignment</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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