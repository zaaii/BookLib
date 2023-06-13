<?php
session_start();
date_default_timezone_set('Asia/Singapore');
require("model.php");

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

$newUsers = getLastRegistered();
$users = getData("users");
$books = getData("books");

$countBook = count($books);
$countUser = count($users);


// Check Role user
checkRole($_SESSION);

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
   <!-- Wrapper Start -->
   <div class="wrapper">
      <!-- Sidebar  -->
      <?php require("sidebar.php") ?>
   </div>
   <!-- TOP Nav Bar -->
   <?php require("navbar.php") ?>
   <!-- TOP Nav Bar END -->
   <!-- Page Content  -->
   <div id="content-page" class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6 col-lg-4">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-body">
                     <div class="d-flex align-items-center">
                        <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-line"></i></div>
                        <div class="text-left ml-3">
                           <h2 class="mb-0"><span class="counter"><?= $countUser ?></span></h2>
                           <h5 class="">Users</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-body">
                     <div class="d-flex align-items-center">
                        <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-book-line"></i></div>
                        <div class="text-left ml-3">
                           <h2 class="mb-0"><span class="counter"><?= $countBook ?></span></h2>
                           <h5 class="">Books</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-body">
                     <div class="d-flex align-items-center">
                        <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-shopping-cart-2-line"></i></div>
                        <div class="text-left ml-3">
                           <h2 class="mb-0"><?php echo date("h:i A"); ?></span></h2>
                           <h5 class="">Current Time</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-12">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">Last Registered Users</h4>
                     </div>
                     <div class="iq-card-header-toolbar d-flex align-items-center">
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                           <thead>
                              <tr>
                                 <th scope="col">Photo</th>
                                 <th scope="col">Full Name</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Gender</th>
                                 <th scope="col">Date Created</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              foreach ($newUsers as $row) {
                                 echo '<tr>';
                                 echo '<td class="text-center">';
                                 if (empty($row['USER_PHOTO'])) {
                                    echo '<img class="rounded img-fluid avatar-40" src="resources/profile/default.jpg" alt="user">';
                                 } else {
                                    echo '<img class="rounded img-fluid avatar-40" src="resources/profile/' . $row['USER_PHOTO'] . '" alt="profile">';
                                 }
                                 echo '</td>';
                                 echo '<td>' . $row['FULL_NAME'] . '</td>';
                                 echo '<td>' . $row['EMAIL'] . '</td>';
                                 if (empty($row['GENDER'])) {
                                    echo '<td><span class="badge iq-bg-danger">Not Set</span></td>';
                                 } else {
                                    echo '<td><span class="badge iq-bg-primary">' . $row['GENDER'] . '</span></td>';
                                 }
                                 echo '<td>' . $row['DATE_CREATED'] . '</td>';
                                 echo '<td>';
                                 echo '</td>';
                                 echo '</tr>';
                              } ?>
                           </tbody>
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
   </div>

   <!-- Wrapper END -->
   <!-- Footer -->
   <?= require('footer.php') ?>
   <!-- Footer END -->
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
   <!-- Raphael-min JavaScript -->
   <script src="js/raphael-min.js"></script>
   <!-- Morris JavaScript -->
   <script src="js/morris.js"></script>
   <!-- Morris min JavaScript -->
   <script src="js/morris.min.js"></script>
   <!-- Flatpicker Js -->
   <script src="js/flatpickr.js"></script>
   <!-- Style Customizer -->
   <script src="js/style-customizer.js"></script>
   <!-- Chart Custom JavaScript -->
   <script src="js/chart-custom.js"></script>
   <!-- Custom JavaScript -->
   <script src="js/custom.js"></script>
</body>

</html>