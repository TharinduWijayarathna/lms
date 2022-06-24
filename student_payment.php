<?php
session_start();

require "connection.php";

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



                            <div class="col-12 col-md-4 offset-md-4 offset-0 mt-5 grid-margin">
                                <div class="card">
                                    <div class="card-body">


                                        <div class="card-body">
                                            <h4 class="card-title text-center">Student Portal Payment Process</h4>
                                            <p class="card-description ">
                                                Fill the form
                                            </p>
                                            <div class="forms-sample">
                                                <div class="form-group">
                                                    <label for="nic">NIC</label>
                                                    <input type="text" class="form-control" id="nic" placeholder="NIC">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email address</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="pw">Password</label>
                                                    <input type="password" class="form-control" id="pw" placeholder="Password">
                                                </div>
                                             
                                                <button type="submit" class="btn btn-primary mr-2 col-12" onclick="payment_data();">Submit</button>
                                               
                                            </div>
                                        </div>

                                    </div>
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