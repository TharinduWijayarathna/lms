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
                            <div class="mb-4 mt-4">
                                <h4 class="font-weight-bold">Add Assignment Marks</h4>
                                <h5>You can add marks to viewed answer sheets only</h5>
                            </div>


                            <?php
                            //search details from upload assignment table
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
                                                            <th class="col-2">
                                                                Student ID
                                                            </th>
                                                            <th class="col-3">
                                                                Description
                                                            </th>
                                                            <th class="coll-2">
                                                                Deadline
                                                            </th>
                                                            <th class="col-2">
                                                                Viwed or Not
                                                            </th>
                                                            <th class="col-2">
                                                                Marks
                                                            </th>
                                                            <th class="col-1">
                                                                Confirm Change
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        //search assignments
                                                        $query = Database::search("SELECT * FROM `added_assignment` WHERE `id` = '" . $udata["added_assignment_id"] . "' AND `teachers_id` = '" . $_SESSION["t"]["id"] . "'");
                                                        $qnum = $query->num_rows;

                                                        for ($i = 0; $i < $qnum; $i++) {
                                                            $data = $query->fetch_assoc();

                                                            //search assignment details from upload_assignment table
                                                            $added = Database::search("SELECT * FROM `upload_assignment` WHERE `added_assignment_id` = '" . $data["id"] . "'");
                                                            $adata = $added->fetch_assoc();

                                                            //search details from students table
                                                            $student = Database::search("SELECT `nic` FROM `students` WHERE `id` = '" . $adata["students_id"] . "'");
                                                            $sdata = $student->fetch_assoc();

                                                            //search details from student_result table
                                                            $marks = Database::search("SELECT * FROM `student_results` WHERE `upload_assignment_id` = '" . $adata["id"] . "' AND `students_id` = '" . $adata["students_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `subject_id` = '" . $data["subject_id"] . "'");
                                                            $markr = $marks->num_rows;

                                                            //print data after search
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $sdata["nic"] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $data["description"] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $data["last_date"] ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    //if assignment is viewed
                                                                    if ($adata["viewed_or_not_id"] == 1) {
                                                                    ?>
                                                                        <label class="badge badge-info">Viewed</label>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <label class="badge badge-danger">Not Viewed</label>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    //check student results
                                                                    if ($markr == 1) {
                                                                        $mdata = $marks->fetch_assoc();
                                                                    ?>
                                                                        <input type="number" class="form-control" id="marks<?php echo $adata["id"] ?>" value="<?php echo $mdata["result"] ?>">
                                                                        <?php
                                                                    } else {
                                                                        //check upload assignment is viewed or not
                                                                        if ($adata["viewed_or_not_id"] == 1) {
                                                                        ?>
                                                                            <input type="number" class="form-control" id="marks<?php echo $adata["id"] ?>" placeholder="Add Marks">
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <label class="badge badge-warning">Not Viewed</label>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    //check upload assignment is viewed or not
                                                                    if ($adata["viewed_or_not_id"] == 1) {
                                                                    ?>
                                                                        <button class="btn btn-outline-success" onclick="add_or_change_marks(<?php echo $adata['id'] ?>);"><i class="ti-check"></i></button>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <button class="btn btn-outline-danger" disabled><i class="ti-close"></i></button>
                                                                    <?php
                                                                    }
                                                                    ?>
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
                            <?php
                            }
                            ?>

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
        window.location = "teacher_login.php";
    </script>

<?php
}
?>