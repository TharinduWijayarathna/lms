<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
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
    <div class=" container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel w-100  documentation">
          <div class="content-wrapper">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 pt-5">
                  <a class="btn btn-primary" href="admin_dashboard.php"><i class="ti-home mr-2"></i>Back to Dashboard</a>
                </div>
              </div>
              <div class="row pt-2 mt-2 justify-content-center">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Send invitations to teachers</h4>
                      <h4 class="text-danger" id="talert"></h4>
                      <p class="card-description">
                        Fill the form
                      </p>
                      <div class="forms-sample">
                        <div class="form-group">
                          <label for="tfname">First Name</label>
                          <input type="text" class="form-control" id="tfname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                          <label for="tlname">Last Name</label>
                          <input type="text" class="form-control" id="tlname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                          <label for="tusername">Username</label>
                          <input type="text" class="form-control" id="tusername" placeholder="Username">
                        </div>
                        <div class="form-group">
                          <label for="temail">Email address</label>
                          <input type="email" class="form-control" id="temail" placeholder="Email">
                        </div>
                        <div class="form-group">
                          <label for="tgender">Gender</label>

                          <select class="form-control" id="tgender">
                            <option>Male</option>
                            <option>Female</option>
                          </select>

                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="tpw" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputConfirmPassword1">Confirm Password</label>
                          <input type="password" class="form-control" id="trpw" placeholder="Password">
                        </div>


                        <button class="btn btn-info mr-2" onclick="addteachers();">Send Invitation</button>
                        <button class="btn btn-secondary" onclick="teacherfields();">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Send invitations to academic officers</h4>
                      <h4 class="text-danger" id="aalert"></h4>
                      <p class="card-description">
                        Fill the form
                      </p>
                      <div class="forms-sample">
                        <div class="form-group">
                          <label for="afname">First Name</label>
                          <input type="text" class="form-control" id="afname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                          <label for="alname">Last Name</label>
                          <input type="text" class="form-control" id="alname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                          <label for="ausername">Username</label>
                          <input type="text" class="form-control" id="ausername" placeholder="Username">
                        </div>
                        <div class="form-group">
                          <label for="aemail">Email address</label>
                          <input type="email" class="form-control" id="aemail" placeholder="Email">
                        </div>
                        <div class="form-group">
                          <label for="agender">Gender</label>

                          <select class="form-control" id="agender">
                            <option>Male</option>
                            <option>Female</option>
                          </select>

                        </div>
                        <div class="form-group">
                          <label for="apw">Password</label>
                          <input type="password" class="form-control" id="apw" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="arpw">Confirm Password</label>
                          <input type="password" class="form-control" id="arpw" placeholder="Password">
                        </div>

                        <button class="btn btn-info mr-2" onclick="addofficers();">Send Invitation</button>
                        <button class="btn btn-secondary" onclick="officerfields();">Cancel</button>
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
  //redirect
?>
  <script>
    window.location = "admin_login.php";
  </script>
<?php
}
?>