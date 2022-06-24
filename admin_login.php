<?php

require "connection.php";

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
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <?php
              $u = "";
              $p = "";

              //check cookie data
              if (isset($_COOKIE["u"])) {
                $u = $_COOKIE["u"];
              }
              if (isset($_COOKIE["p"])) {
                $p = $_COOKIE["p"];
              }
              ?>
              <div class="brand-logo">
                <img src="images/logo.png" alt="logo" />
              </div>
              <h4>Hello! Log into admin's dashboard</h4>
              <h6 class="font-weight-light" id="errortext">Sign in to continue.</h6>
              <div class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="adminus" placeholder="Username" value="<?php echo $u; ?>" />
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="adminpw" placeholder="Password" value="<?php echo $p; ?>" />
                </div>
                <div class="mt-3">
                  <button onclick="admin_login();" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" id="remember" />
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" onclick="load_email_model();" class="auth-link text-black">Forgot password?</a>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- modal -->

  <div class="modal fade" tabindex="-1" id="emailpopup">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Enter Admin Email</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <div class="col-12">
            <label class="form-label">Email</label>
            <input class="form-control" type="text" id="email" />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="send_admin_email();">Check Email</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" id="forgetPasswordModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Password Reset</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-6">
              <label class="form-label">New Password</label>
              <div class="input-group mb-3">
                <input class="form-control" type="password" id="np" />
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" id="npbtn1" type="button" onclick="showPassword1();">Show</button>
                </div>
              </div>
            </div>
            <div class="col-6">
              <label class="form-label">Re-type Password</label>
              <div class="input-group mb-3">
                <input class="form-control" type="password" id="rnp" />
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" id="npbtn2" type="button" onclick="showPassword2();">Show</button>
                </div>

              </div>
            </div>
            <div class="col-12">
              <label class="form-label">Verification Code</label>
              <input class="form-control" type="text" id="vc" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="reset_admin_password();">Reset</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->

  <!-- inject:js -->
  <script src="js/template.js"></script>

  <script src="js/script.js"></script>
</body>

</html>