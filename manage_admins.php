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
                  <a class="btn btn-primary" href="admin_dashboard.php"><i class="ti-home mr-2"></i>Back to home</a>
                  <a class="btn btn-info" href="addadmins.php"><i class="ti-plus mr-2"></i>Add New Admin</a>
                </div>
              </div>




              <div class="row pt-2 mt-2">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Manage Administrators</p>
                      <div class="row">
                        <div class="col-12">
                          <div class="table-responsive">
                            <table id="example" class="display expandable-table" style="width: 100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Admin ID</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Username</th>
                                  <th>Email</th>
                                  <th>Change Status</th>
                                  <th>Delete</th>
                                </tr>

                                <?php
                                //search all admins
                                $query = Database::search("SELECT * FROM `admin`;");
                                $num_rows = $query->num_rows;

                                for ($i = 0; $i < $num_rows; $i++) {
                                  $data = $query->fetch_assoc();

                                ?>
                                  <tr class="text-center">
                                    <td><?php echo $data["id"] ?></td>
                                    <td><?php echo $data["first_name"] ?></td>
                                    <td><?php echo $data["last_name"] ?></td>
                                    <td><?php echo $data["username"] ?></td>
                                    <td><?php echo $data["email"] ?></td>

                                    <?php
                                    if ($data["status_id"] == 1) {
                                    ?>
                                      <td><button class="btn btn-inverse-danger col-12" onclick="admin_action(<?php echo $data['id'] ?>);" id="actionbtn<?php echo $data['id'] ?>">Deactive</button></td>
                                    <?php
                                    } else {
                                    ?>
                                      <td><button class="btn btn-inverse-success col-12" onclick="admin_action(<?php echo $data['id'] ?>);" id="actionbtn<?php echo $data['id'] ?>">Active</button></td>
                                    <?php
                                    }
                                    ?>

                                    <td><button class="btn btn-inverse-info col-12" onclick="delete_admin(<?php echo $data['id'] ?>);">Delete</button></td>

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
    window.location = "index.php";
  </script>



<?php

}
?>