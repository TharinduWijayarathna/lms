<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {

  //time zone
  date_default_timezone_set('Asia/Colombo');


  //get count of teachers
  $teachers = Database::search("SELECT * FROM `teachers`");
  $tnum = $teachers->num_rows;

  //get count of teachers academic officer 
  $academic = Database::search("SELECT * FROM `academic_officers`");
  $anum = $academic->num_rows;

  //get count of  student details
  $students = Database::search("SELECT * FROM `students`");
  $snum = $students->num_rows;

  //get count of  details from admin
  $admins = Database::search("SELECT * FROM `admin`");
  $adnum = $admins->num_rows;

  //date
  $date = date('Y/m/d');

  //get count of today registered teachers
  $todayteachers = Database::search("SELECT * FROM `teachers` WHERE `registered_on` = '" . $date . "'");
  $ttnum = $todayteachers->num_rows;

  //get count of today registered academic officers
  $todayofficers = Database::search("SELECT * FROM `academic_officers` WHERE `registered_on` = '" . $date . "'");
  $tonum = $todayofficers->num_rows;
  
  //get count of today registered students
  $todaystudents = Database::search("SELECT * FROM `students` WHERE `registered_on` = '" . $date . "'");
  $tsnum = $todaystudents->num_rows;

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
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell mx-0"></i>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">
                  Notifications
                </p>
                <?php
                if ($ttnum >= 1) {
                ?>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="ti-info mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">
                        New Teacher Registered
                      </h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        Today
                      </p>
                    </div>
                  </a>
                <?php
                }
                if ($tonum >= 1) {
                ?>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="ti-briefcase mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">
                        New Academic Officer <br> Registered
                      </h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        Today
                      </p>
                    </div>
                  </a>
                <?php
                }
                if ($tsnum >= 1) {
                ?>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="ti-user mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">
                        New Student Registered
                      </h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        Today
                      </p>
                    </div>
                  </a>
                <?php
                }
                ?>

              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <?php
                //search photo
                $imgfind = Database::search("SELECT * FROM `admin_img` WHERE `admin_id` = '" . $_SESSION["a"]["id"] . "'");
                $inum = $imgfind->num_rows;

                //is there any value or not
                if ($inum == 1) {
                  $idata = $imgfind->fetch_assoc();
                ?>
                  <img src="images/admin_profiles/<?php echo $idata["path"] ?>" alt="profile">
                <?php
                } else {
                ?>
                  <img src="images/faces/upload.png" alt="profile" />
                <?php
                }
                ?>

              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="update_admin_profile.php">
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
              <a class="nav-link" href="admin_dashboard.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="send_invitations.php">
                <i class="icon-share menu-icon"></i>
                <span class="menu-title">Send Invitations</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manage_admins.php">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Manage Admins</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manage_teachers.php">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Manage Teachers</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manage_officers.php">
                <i class="icon-command menu-icon"></i>
                <span class="menu-title">Manage Academic <br> Officers</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manage_students.php">
                <i class="icon-ellipsis menu-icon"></i>
                <span class="menu-title">Manage Students</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="check_result.php">
                <i class="icon-circle-check menu-icon"></i>
                <span class="menu-title">Check Results</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_grade_and_subject.php">
                <i class="icon-marquee-plus menu-icon"></i>
                <span class="menu-title">Add Grade / Subject</span>
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
                    <h3 class="font-weight-bold">Welcome <?php echo $_SESSION["a"]["first_name"] . " " . $_SESSION["a"]["last_name"] ?></h3>
                    <h6 class="font-weight-normal mb-0">
                      All systems are running smoothly!
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
                  <div class="col-md-3 mb-5 stretch-card transparent">
                    <div class="card bg-gradient-primary">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Total Teachers Registered On System</p>
                        <p class="fs-30 mb-2"><?php echo $tnum; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-5 stretch-card transparent">
                    <div class="card bg-gradient-danger">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Total Academic Officers Registered On System</p>
                        <p class="fs-30 mb-2"><?php echo $anum ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-5 stretch-card transparent">
                    <div class="card bg-gradient-warning">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Total Students Registered On System</p>
                        <p class="fs-30 mb-2"><?php echo $snum ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-5 stretch-card transparent">
                    <div class="card bg-gradient-success">
                      <div class="card-body">
                        <p class="mb-4 font-weight-bolder">Total Administrators Controlling System</p>
                        <p class="fs-30 mb-2"><?php echo $adnum ?></p>
                      </div>
                    </div>
                  </div>



                </div>
              </div>



              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">

                  <div class="card-body">
                    <p class="card-title">Recent Updates</p>
                    <p class="font-weight-bold ">
                      Types of users who joined today to use the system as a new user and their number.
                    </p>

                    <div class="d-flex flex-wrap mt-2 mb-5">
                      <div class="mr-5 mt-3">
                        <p class="text-muted">Teachers</p>
                        <h3 class="text-primary fs-30 font-weight-medium">
                          <?php echo $ttnum ?>
                        </h3>
                      </div>
                      <div class="mr-5 mt-3">
                        <p class="text-muted">Academic Officers</p>
                        <h3 class="text-primary fs-30 font-weight-medium">
                          <?php echo $tonum ?>
                        </h3>
                      </div>
                      <div class="mr-5 mt-3">
                        <p class="text-muted">Students</p>
                        <h3 class="text-primary fs-30 font-weight-medium">
                          <?php echo $tsnum ?>
                        </h3>
                      </div>
                      <img src="images/report.svg" class="col-12" alt="">
                    </div>
                  </div>
                </div>
              </div>
              <?php
              //get paid and not paid students details from database 
              $paid = Database::search("SELECT * FROM `students` WHERE `trial_or_paid_id` = '1'");
              $paidnum = $paid->num_rows;

              $notpaid = Database::search("SELECT * FROM `students` WHERE `trial_or_paid_id` = '2'");
              $notpaidnum = $notpaid->num_rows;
              ?>

              <input type="text" class="d-none" id="paid" value="<?php echo $paidnum ?>">
              <input type="text" class="d-none" id="notpaid" value="<?php echo $notpaidnum ?>">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <p class="card-title">Payment Report</p>

                    </div>
                    <p class="font-weight-bold">
                      Paid Students vs Unpaid Students
                    </p>

                    <div class="card-body">
                      <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                          <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                          <div class=""></div>
                        </div>
                      </div>

                      <canvas id="doughnutChart" style="display: block;" class="chartjs-render-monitor col-12"></canvas>
                    </div>
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


?>
  <script>
    window.location = "admin_login.php";
  </script>



<?php
}
?>