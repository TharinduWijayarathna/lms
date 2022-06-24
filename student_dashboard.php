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
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
            <?php
            //check verification id from session
            if ($_SESSION["s"]["verification_id"] == 1) {
            ?>
              <li class="nav-item"><img src="images/verified.png" width="75px" srcset=""></li>
            <?php
            }
            ?>

            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell mx-0"></i>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">
                  Notifications
                </p>

                <a class="dropdown-item preview-item">


                  <?php
                  //search details from added assignment table
                  $assignment = Database::search("SELECT * FROM `added_assignment` WHERE `grade_id` = '" . $_SESSION["s"]["grade_id"] . "' AND `start_date` = '" . date("Y-m-d") . "'");
                  $numr = $assignment->num_rows;

                  //if row count is greater than or equals 1
                  if ($numr >= 1) {
                  ?>
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="ti-info mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">
                        New Assignment Added
                      </h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        Today
                      </p>
                    </div>
                  <?php
                  }
                  ?>

                </a>

              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <?php
                //search details from student img table
                $imgfind = Database::search("SELECT * FROM `student_img` WHERE `students_id` = '" . $_SESSION["s"]["id"] . "'");
                $inum = $imgfind->num_rows;

                //if row count is equals to 1
                if ($inum == 1) {
                  $idata = $imgfind->fetch_assoc();
                ?>
                  <img src="images/student_profile/<?php echo $idata["path"] ?>" alt="profile">
                <?php
                } else {
                ?>
                  <img src="images/faces/upload.png" alt="profile" />
                <?php
                }
                ?>

              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="update_student_profile.php">
                  <i class="ti-settings text-primary"></i>
                  Update Profile
                </a>
                <a class="dropdown-item" href="logout.php">
                  <i class="ti-power-off text-primary"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="student_dashboard.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view_lesson_notes.php">
                <i class="icon-book menu-icon"></i>
                <span class="menu-title">View lesson notes</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view_assignments.php">
                <i class="icon-cloud-download  menu-icon"></i>
                <span class="menu-title">View & Download <br> Assignments</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="upload_assignment.php">
                <i class="icon-upload menu-icon"></i>
                <span class="menu-title">Upload Answer Sheet</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="view_marks.php">
                <i class="icon-paper-stack menu-icon"></i>
                <span class="menu-title">View Marks</span>
              </a>
            </li>

          </ul>
        </nav>


        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <?php echo $_SESSION["s"]["first_name"] . " " . $_SESSION["s"]["last_name"] ?></h3>
                    <h6 class="font-weight-normal mb-0 ">
                      Check assignments and lesson notes daily !

                      <span class="text-primary font-weight-bold">Check your notifications !</span>
                    </h6>
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                      <div class="flex-md-grow-1 flex-xl-grow-0">
                        <button class="btn btn-sm btn-light bg-white" type="button" aria-haspopup="true" aria-expanded="true">
                          <i class="mdi mdi-calendar"></i> <?php echo date('l jS \of F Y '); ?>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12 grid-margin transparent">
                <div class="row">

                  <div class="col-md-6 mb-3 stretch-card transparent">
                    <div class="card bg-gradient-danger">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Your NIC</p>
                        <p class="fs-30 mb-2"><?php echo $_SESSION["s"]["nic"] ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3 stretch-card transparent">
                    <div class="card bg-gradient-warning">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Your Grade</p>
                        <?php
                        //search details from grade table
                        $grade_load = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $_SESSION["s"]["grade_id"] . "'");
                        $gdata = $grade_load->fetch_assoc();
                        ?>
                        <p class="fs-30 mb-2"><?php echo $gdata["grade"] ?></p>
                      </div>
                    </div>
                  </div>




                </div>
              </div>

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">

                  <div class="card-body">
                    <p class="card-title">Latest Added Assignments</p>
                    <p class="font-weight-bold ">
                      Assignments you added according to aasigned grade and subject
                    </p>

                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Subject</th>

                            <th>Last Date</th>
                            <th>Status</th>
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

                            //seach details from upload assignment table 
                            $submit_status = Database::search("SELECT * FROM `upload_assignment` WHERE `added_assignment_id` = '" . $data["id"] . "' AND `subject_id` = '" . $data["subject_id"] . "' AND `grade_id` = '" . $data["grade_id"] . "' AND `students_id` = '" . $_SESSION["s"]["id"] . "'");
                            $sstatus = $submit_status->num_rows;

                          ?>
                            <tr>
                              <td><?php echo $subdata["subject"] ?></td>

                              <td><?php echo $data["last_date"] ?></td>
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

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">

                  <div class="card-body">
                    <p class="card-title">Latest added lesson notes</p>
                    <p class="font-weight-bold">
                      Lesson notes you added according to aasigned grade and subject
                    </p>

                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Subject</th>
                            <th>Decription</th>

                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          //search details fron lesson notes table
                          $query_les = Database::search("SELECT * FROM `lesson_notes` WHERE `grade_id` = '" . $_SESSION["s"]["grade_id"] . "'");
                          $les_n = $query_les->num_rows;

                          for ($i = 0; $i < $les_n; $i++) {
                            $les_data = $query_les->fetch_assoc();

                            //search details from subject table
                            $les_subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $les_data["subject_id"] . "'");
                            $subdata = $les_subject->fetch_assoc();


                          ?>
                            <tr>
                              <td><?php echo $subdata["subject"] ?></td>
                              <td><?php echo $les_data["description"] ?></td>

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


            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
          </div>
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                <a href="#" target="_blank">Tharindu Wijayarathna</a>
                from JIAT. All rights reserved.</span>

            </div>
          </footer>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->

      <script src="vendors/js/Chart.min.js"></script>
      <!-- plugins:js -->
      <script src="vendors/js/vendor.bundle.base.js"></script>
      <!-- endinject -->
      <script src="js/chart.js"></script>
      <!-- inject:js -->
      <script src="js/template.js"></script>

      <script src="js/off-canvas.js"></script>
  </body>

  </html>
<?php
} else {


?>
  <script>
    window.location = "student_login.php";
  </script>



<?php
}
?>