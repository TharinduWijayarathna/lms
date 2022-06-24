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
                                    <a class="btn btn-primary" href="manage_teachers.php"><i class="ti-back-left mr-2"></i>Back to Manage Teachers</a>
                                    <a class="btn btn-info" href="new_assign_teacher_for_subjects.php"><i class="ti-shift-right mr-2"></i>Assign for Subjects</a>
                                </div>
                            </div>

                            <div class="input-group col-5 mt-4">

                                <input type="text" class="form-control" id="tsearch" placeholder="Search now" aria-label="search" aria-describedby="search">
                                <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                    <button class="input-group-text bg-inverse-info text-dark" onclick="teacher_assign_search();">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                            </div>






                            <div class="row pt-2 mt-2">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-title">Subject Assigned Teachers List</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table id="example" class="display expandable-table" style="width: 100%">
                                                            <thead id="insidetable">
                                                                <tr class="text-center">

                                                                    <th>Teacher ID</th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name</th>

                                                                    <th>Email</th>
                                                                    <th>Assigned Subject</th>
                                                                    <th>Assigned Grade</th>
                                                                    <th>Unassign</th>

                                                                </tr>

                                                                <?php
                                                                //search teachers details joining assigned subejct table

                                                                $query = Database::search("SELECT * FROM `teachers` INNER JOIN `assigned_subject` ON `teachers`.`id` = `assigned_subject`.`teachers_id`");
                                                                $num_rows = $query->num_rows;

                                                                for ($i = 0; $i < $num_rows; $i++) {
                                                                    $data = $query->fetch_assoc();

                                                                    //serach details from subejct
                                                                    $subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $data["subject_id"] . "'");
                                                                    $subdata = $subject->fetch_assoc();

                                                                    //search details from grade table
                                                                    $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
                                                                    $gradedata = $grade->fetch_assoc();

                                                                    //print data
                                                                ?>
                                                                    <input type="text" id="subject_id<?php echo $data['teachers_id'] ?>" style="display: none;" value="<?php echo $data["subject_id"] ?>">
                                                                    <input type="text" id="grade_id<?php echo $data['teachers_id'] ?>" style="display: none;" value="<?php echo $data["grade_id"] ?>">
                                                                    <tr class="text-center">

                                                                        <td><?php echo $data["id"] ?></td>
                                                                        <td><?php echo $data["first_name"] ?></td>
                                                                        <td><?php echo $data["last_name"] ?></td>

                                                                        <td><?php echo $data["email"] ?></td>
                                                                        <td><?php echo $subdata["subject"] ?></td>
                                                                        <td><?php echo $gradedata["grade"] ?></td>
                                                                        <td><button class="btn  btn-inverse-danger" onclick="unassign_teachers(<?php echo $data['teachers_id'] ?>);">Unassign</button></td>

                                                                    </tr>

                                                                <?php
                                                                }
                                                                ?>


                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
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