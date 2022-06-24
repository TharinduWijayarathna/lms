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
                                    <a class="btn btn-primary" href="academic_officer_dashboard.php"><i class="ti-back-left mr-2"></i>Back to Dashboard</a>

                                </div>
                            </div>

                            <?php
                            //search details from academic officer table
                            $officer = Database::search("SELECT * FROM `academic_officers` WHERE `id` = '" . $_SESSION["o"]["id"] . "'");
                            $data = $officer->fetch_assoc();
                            ?>
                            <div class="col-12 mt-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Update Your Profile</h4>
                                        <h4 class="text-danger" id="alert"></h4>
                                        <p class="card-description">
                                            Add an image for your profile image
                                        </p>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Your Profile Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" style="display: none;" accept="image/*" id="imgupload" />
                                                        <label for="imgupload" class="btn btn-outline-danger btn-icon-text" onclick="changeimage();"><i class="ti-upload btn-icon-prepend"></i> Upload </label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                //search details from officer img table
                                                $imgfind = Database::search("SELECT * FROM `officer_img` WHERE `academic_officers_id` = '" . $_SESSION["o"]["id"] . "'");
                                                $inum = $imgfind->num_rows;

                                                //if row count is equals to  1
                                                if ($inum == 1) {
                                                    $idata = $imgfind->fetch_assoc();
                                                ?>
                                                    <img src="images/officer_profile/<?php echo $idata["path"] ?>" id="imageload" width="100px" height="100px" style="border-radius: 50%;" alt="">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="images/faces/upload.png" id="imageload" width="100px" height="100px" style="border-radius: 50%;" alt="">
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <p class="card-description">
                                            Enter your Details
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="fname" value="<?php echo $data["first_name"] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Last Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="lname" value="<?php echo $data["last_name"] ?>" />
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
                                                            <?php if ($data["gender_id"] == 1) {
                                                            ?>
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option>Female</option>
                                                                <option>Male</option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" placeholder="Email" id="email" value="<?php echo $data["email"] ?>" />
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
                                                        <input type="text" class="form-control" id="username" value="<?php echo $data["username"] ?>" />
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

                                        <button class="btn btn-inverse-success col-4 offset-4" onclick="update_officer();">Update</button>

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
    //redirect
?>
    <script>
        window.location = "academic_officer_login.php";
    </script>

<?php
}
?>