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
                                    <a href="new_lesson_notes.php" class="btn btn-info"><i class="icon-plus"></i> &nbsp; Add Lesson Notes</a>
                                </div>
                            </div>


                            <div class="card-body">
                                <h4 class="card-title">Add or Remove Lesson Notes</h4>
                                <p class="card-description">
                                    Click confirm after doing updates
                                </p>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>

                                                <th>Assigned Subject</th>
                                                <th>Assigned Grade</th>
                                                <th>Description</th>
                                                <th>Submitted Status</th>
                                                <th>Add / Replace Notes</th>
                                                <th>Confirm</th>
                                                <th>Remove Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //search lesson notes

                                            $query = Database::search("SELECT * FROM `lesson_notes` WHERE `teachers_id` = '" . $_SESSION["t"]["id"] . "'");
                                            $qnum = $query->num_rows;

                                            for ($i = 0; $i < $qnum; $i++) {
                                                $data = $query->fetch_assoc();

                                                //search details from subject table

                                                $subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $data["subject_id"] . "'");
                                                $subdata = $subject->fetch_assoc();

                                                //search details from grade table

                                                $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
                                                $gradedata = $grade->fetch_assoc();

                                                //search details from lesson_notes table
                                                $notes = Database::search("SELECT * FROM `lesson_notes` WHERE `teachers_id` = '" . $data["teachers_id"] . "' AND `subject_id` = '" . $data["subject_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "'");
                                                $notenum = $notes->num_rows;
                                            ?>
                                                <tr>

                                                    <td><?php echo $subdata["subject"] ?></td>
                                                    <td><?php echo $gradedata["grade"] ?></td>

                                                    <input type="text" disabled value="<?php echo $data["subject_id"] ?>" style="display: none;" id="subid<?php echo $data['id'] ?>">
                                                    <input type="text" disabled value="<?php echo $data["grade_id"] ?>" style="display: none;" id="gradeid<?php echo $data['id'] ?>">


                                                    <?php
                                                    if ($notenum != 0) {
                                                        $notedata = $notes->fetch_assoc();
                                                    ?>

                                                        <td> <input class="form-control" type="text" value="<?php echo $notedata["description"] ?>" id="desc<?php echo $data["id"] ?>"></td>
                                                        <td><label class="badge badge-info col-12" id="substatus<?php echo $data["id"] ?>">Submitted</label></td>
                                                        <td>

                                                            <input type="file" style="display: none;" accept=".pdf ,.doc ,.docx" id="notes<?php echo $data["id"] ?>" />
                                                            <label for="notes<?php echo $data["id"] ?>" class="btn btn-outline-info btn-icon-text col-12" onclick="changesubicon(<?php echo $data['id'] ?>);"><i class="ti-upload btn-icon-prepend"></i> Upload </label>
                                                        <td>
                                                            <button id="upload<?php echo $data["id"] ?>" style="display: none;" onclick="lesson_notes(<?php echo $data['id'] ?>);">Confirm</button>
                                                            <label for="upload<?php echo $data["id"] ?>" class="btn btn-outline-dark col-12"><i class="ti-check btn-icon-prepend"></i> Confirm</label>
                                                        </td>



                                                        </td>
                                                        <td>
                                                            <button style="display: none;" id="remove<?php echo $data["id"] ?>" onclick="removenotes(<?php echo $data['id'] ?>);">Remove</button>
                                                            <label for="remove<?php echo $data["id"] ?>" class="btn btn-outline-danger col-12"><i class="ti-trash"></i> Remove</label>

                                                        </td>
                                                    <?php
                                                    }

                                                    ?>
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