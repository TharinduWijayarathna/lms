<?php
session_start();

if (isset($_SESSION["pd"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <script src="https://js.stripe.com/v3/"></script>

    </head>

    <body>
        <div class="loading-gif">
            <div class="inside-div">
                <div></div>
            </div>
        </div>

        <style>
            @keyframes inside-div {
                0% {
                    transform: rotate(0deg)
                }

                50% {
                    transform: rotate(180deg)
                }

                100% {
                    transform: rotate(360deg)
                }
            }

            .inside-div div {
                position: absolute;
                animation: inside-div 1s linear infinite;
                width: 160px;
                height: 160px;
                top: 20px;
                left: 20px;
                border-radius: 50%;
                box-shadow: 0 4px 0 0 #93dbe9;
                transform-origin: 80px 82px;
            }

            .loading-gif {
                width: 200px;
                height: 200px;
                overflow: hidden;
                background: none;
                margin: auto;
                margin-top: 15%;
            }

            .inside-div {
                width: 100%;
                height: 100%;
                position: relative;
                transform: translateZ(0) scale(1);
                backface-visibility: hidden;
                transform-origin: 0 0;

            }

            .inside-div div {
                box-sizing: content-box;
            }
        </style>
        <script>
            //stripe gateway
            var stripe = Stripe("pk_test_51KuPgjGWiCVv7LRguEjCymCjVroqevs5NYq7Ew0vdaSkiARGVu2EwIPsAT15qJcRI1CGlShhJu7lSdUevjt08KNC00s2PkV2NE");
            document.addEventListener("DOMContentLoaded", function() {
                stripe.redirectToCheckout({
                        lineItems: [{
                            price: "price_1L9WNPGWiCVv7LRg2wLw7C2b",
                            quantity: 1,
                        }, ],
                        mode: "subscription",
                        successUrl: "http://localhost/lms/payment_success.php",
                        cancelUrl: "http://localhost/lms/student_login.php/",
                    })
                    .then(function(result) {});
            });
        </script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "student_login.php"
    </script>
<?php
}
?>