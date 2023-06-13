<?php
session_start();
require("model.php");

if(!isset($_GET["token"]) || !checkToken($_GET["token"])) {
    header("Location: unauthorized.php");
    exit;
}

if(isset($_POST["submit"])) {
    $newpass = $_POST["npass"];
    $newpass2 = $_POST["npass2"];

    if($newpass === $newpass2) {
        if(newPassword($newpass, $newpass2)){
            $message = "<strong> Password reset successfully!</strong>, please login";
            $alertType = "success";
            $alertIcon = "ri-check-line";
        } else {
            $message = "<strong> Password failed to reset!</strong>,Please Contact Admin";
            $alertType = "denger";
            $alertIcon = "ri-close-line";
        }
    } else {
        $message = "<strong> Passwords aren't the same!</strong>";
        $alertType = "warning";
        $alertIcon = "ri-alert-line";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>BookLib - Online Book Library</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page" style="background-image: url('images/bg.jpg'); background-size: cover; ">
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center page-content rounded">
                    <div class="row m-0">
                      <div class="col-sm-12 sign-in-page-data">
                          <div class="sign-in-from bg-primary rounded">
                                <h3 class="mb-0 text-white">New Password</h3>
                                <p class="text-white">Enter your <strong>New Password</strong> and you'll can sign-in again.</p>
                                <?php if (isset($message)) : ?>
                                    <div class="alert alert-<?= $alertType ?> mr-0 ml-0" role="alert">
                                        <div class="iq-alert-icon">
                                            <i class="<?= $alertIcon ?>"></i>
                                        </div>
                                        <div class="iq-alert-text"><?= $message ?></div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <form method="POST" class="mt-4 form-text">
                                    <div class="form-group">
                                        <label for="npass">New Password</label>
                                        <input type="password" class="form-control mb-0" name="npass" placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="npass2">Re-type New Password</label>
                                        <input type="password" class="form-control mb-0" name="npass2" placeholder="Re-type your password">
                                    </div>
                                    <div class="d-inline-block w-100">
                                        <button type="submit" name="submit" class="btn btn-white">Reset Password</button>
                                    </div>
                                </form>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="js/worldLow.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>