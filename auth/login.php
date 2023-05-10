<!doctype html>
<html lang="en">
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>BookLib - Online Library</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/assets/images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="../assets/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="../assets/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="../assets/css/responsive.css">
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/popper.min.js"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
            <!-- Appear JavaScript -->
            <script src="../assets/js/jquery.appear.js"></script>
            <!-- Countdown JavaScript -->
            <script src="../assets/js/countdown.min.js"></script>
            <!-- Counterup JavaScript -->
            <script src="../assets/js/waypoints.min.js"></script>
            <script src="../assets/js/jquery.counterup.min.js"></script>
            <!-- Wow JavaScript -->
            <script src="../assets/js/wow.min.js"></script>
            <!-- Apexcharts JavaScript -->
            <script src="../assets/js/apexcharts.js"></script>
            <!-- Slick JavaScript -->
            <script src="../assets/js/slick.min.js"></script>
            <!-- Select2 JavaScript -->
            <script src="../assets/js/select2.min.js"></script>
            <!-- Owl Carousel JavaScript -->
            <script src="../assets/js/owl.carousel.min.js"></script>
            <!-- Magnific Popup JavaScript -->
            <script src="../assets/js/jquery.magnific-popup.min.js"></script>
            <!-- Smooth Scrollbar JavaScript -->
            <script src="../assets/js/smooth-scrollbar.js"></script>
            <!-- lottie JavaScript -->
            <script src="../assets/js/lottie.js"></script>
            <!-- am core JavaScript -->
            <script src="../assets/js/core.js"></script>
            <!-- am charts JavaScript -->
            <script src="../assets/js/charts.js"></script>
            <!-- am animated JavaScript -->
            <script src="../assets/js/animated.js"></script>
            <!-- am kelly JavaScript -->
            <script src="../assets/js/kelly.js"></script>
            <!-- am maps JavaScript -->
            <script src="../assets/js/maps.js"></script>
            <!-- am worldLow JavaScript -->
            <script src="../assets/js/worldLow.js"></script>
            <!-- Raphael-min JavaScript -->
            <script src="../assets/js/raphael-min.js"></script>
            <!-- Morris JavaScript -->
            <script src="../assets/js/morris.js"></script>
            <!-- Morris min JavaScript -->
            <script src="../assets/js/morris.min.js"></script>
            <!-- Flatpicker Js -->
            <script src="../assets/js/flatpickr.js"></script>
            <!-- Style Customizer -->
            <script src="../assets/js/style-customizer.js"></script>
            <!-- Chart Custom JavaScript -->
            <script src="../assets/js/chart-custom.js"></script>
            <!-- Custom JavaScript -->
            <script src="../assets/js/custom.js"></script>
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center page-content rounded">
                    <div class="row m-0">
                      <div class="col-sm-12 sign-in-page-data">
                          <div class="sign-in-from bg-primary rounded">
                            <?php
                            if (isset($login_result)) {
                                echo "<span class='btn-white d-block rounded w-100 mb-2 text-center' style='color:red;'>$login_result</span>";
                            }
                            ?>
                              <h3 class="mb-0 text-center text-white">Sign in</h3>
                              <p class="text-center text-white">Enter your email address and password.</p>
                              <form class="mt-4 form-text" method="POST">
                                  <div class="form-group">
                                      <label for="email">Email address</label>
                                      <input type="email" class="form-control mb-0" id="email" placeholder="Enter email" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="password">Password</label>
                                      <input type="password" class="form-control mb-0" id="password" placeholder="Password" required>
                                      <a href="#" class="float-right text-dark mt-2">Forgot password?</a>
                                  </div>
                                  <div class="sign-info text-center">
                                      <button type="submit" class="btn btn-white d-block w-100 mb-2">Sign in</button>
                                      <span class="text-dark dark-color d-inline-block line-height-2">Don't have an account? <a href="register.php" class="text-white">Sign up</a></span>
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
</html>
