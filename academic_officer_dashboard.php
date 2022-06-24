<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["o"])) {

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

  <body onload="chart();">
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
            if ($_SESSION["o"]["verification_id"] == 1) {
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
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="ti-info mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">
                      User Profile
                    </h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Update your profile if there are any incorrect detail
                    </p>
                  </div>
                </a>

              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <?php
                //search details from officer img table
                $imgfind = Database::search("SELECT * FROM `officer_img` WHERE `academic_officers_id` = '" . $_SESSION["o"]["id"] . "'");
                $inum = $imgfind->num_rows;

                //if row count is equals to 1
                if ($inum == 1) {
                  $idata = $imgfind->fetch_assoc();
                ?>
                  <img src="images/officer_profile/<?php echo $idata["path"] ?>" alt="profile">
                <?php
                } else {
                ?>
                  <img src="images/faces/upload.png" alt="profile" />
                <?php
                }
                ?>

              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="update_officer_profile.php">
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
              <a class="nav-link" href="academic_officer_dashboard.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register_students.php">
                <i class="icon-circle-plus menu-icon"></i>
                <span class="menu-title">Register Students</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view_and_release_marks.php">
                <i class="icon-square-plus menu-icon"></i>
                <span class="menu-title">View & Release <br> Assignment Marks</span>
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
                    <h3 class="font-weight-bold">Welcome <?php echo $_SESSION["o"]["first_name"] . " " . $_SESSION["o"]["last_name"] ?></h3>
                    <h6 class="font-weight-normal mb-0">
                      Check pending assignment marks and send invitations to new students !
                      <span class="text-primary">Check your notifications !</span>
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
                  <?php
                  //get count from students table
                  $students = Database::search("SELECT * FROM `students`;");
                  $sn = $students->num_rows;

                  //get count from added_assignment table
                  $asi = Database::search("SELECT * FROM `added_assignment`;");
                  $asn = $asi->num_rows;

                  //get count from student_results table
                  $res = Database::search("SELECT * FROM `student_results` WHERE `officer_viewed_status_id` = '2'");
                  $rn = $res->num_rows;
                  ?>


                  <div class="col-md-4 mb-5 stretch-card transparent">
                    <div class="card bg-gradient-danger">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Total Students</p>
                        <p class="fs-30 mb-2"><?php echo $sn ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-5 stretch-card transparent">
                    <div class="card bg-gradient-warning">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Total Assignments</p>
                        <p class="fs-30 mb-2"><?php echo $asn ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-5 stretch-card transparent">
                    <div class="card bg-gradient-success">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Pending Results</p>
                        <p class="fs-30 mb-2"><?php echo $rn ?></p>
                      </div>
                    </div>
                  </div>



                </div>
              </div>


              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">

                  <div class="card-body">
                    <p class="card-title">Latest Released Marks</p>
                    <p class="font-weight-bold ">
                      You can see latest relased marks from teachers
                    </p>

                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>NIC</th>
                            <th>Subject</th>
                            <th>Marks</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          //search latest released results

                          $query = Database::search("SELECT * FROM `student_results` WHERE `officer_viewed_status_id` = '2'");
                          $qnum = $query->num_rows;

                          for ($i = 0; $i < $qnum; $i++) {
                            $data = $query->fetch_assoc();
                             
                            //search from students table 
                            $student = Database::search("SELECT * FROM `students` WHERE `id` = '" . $data["students_id"] . "'");
                            $sdata = $student->fetch_assoc();

                            //search subject details
                            $subject = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $data["subject_id"] . "'");
                            $subdata = $subject->fetch_assoc();

                            //search grade details
                            $grade = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $data["grade_id"] . "'");
                            $gradedata = $grade->fetch_assoc();



                          ?>
                            <tr>
                              <td><?php echo $sdata["nic"] ?></td>
                              <td><?php echo $subdata["subject"] ?></td>
                              <td><?php echo $data["result"] ?></td>

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
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                  <a href="#" target="_blank">Tharindu Wijayarathna</a>
                  from JIAT. All rights reserved.</span>

              </div>
            </footer>
            <!-- partial -->
          </div>
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
  //redirect

?>
  <script>
    window.location = "academic_officer_login.php";
  </script>



<?php
}
?>