<?php
session_start();

require "connection.php";

//check session
if (isset($_SESSION["a"])) {
  //set default time zone
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
                  <a class="btn btn-primary" href="manage_admins.php"><i class="ti-back-left mr-2"></i>Back to Manage Admins</a>

                </div>
              </div>




              <div class="col-12 mt-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Enter the details of new administrator</h4>
                    <h4 class="text-danger" id="alert"></h4>
                    <p class="card-description">
                      Fill the form
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="gender">
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input class="form-control" placeholder="Email" id="email" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <p class="card-description">
                      Enter username for login
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" />
                          </div>
                        </div>
                      </div>

                    </div>

                    <p class="card-description">
                      Enter and confirm your password
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="pw" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Confirm Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="rpw" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <button class="btn btn-inverse-success col-4 offset-4" onclick="addadmin();">Confirm</button>

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
    window.location = "admin_login.php";
  </script>

<?php
}
?>