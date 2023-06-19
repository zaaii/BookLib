<?php
session_start();
date_default_timezone_set('Asia/Singapore');
require("model.php");

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

// Check if sesion user still exists
if (isSessionStillAlive($_SESSION) == false) {
   // jika session is already not exist in database delete existing session
   $_SESSION = [];
   header("Location:login.php");
}

$user = getData("users");
$books = getData("buku");
// Mengambil data buku di database
$categories = getData("categories");

//count data in database
$countUser = count($user);
$countBook = count($books);

$now = date('Y-m-d h:i');
$oneHourAgo = date('Y-m-d h:i', strtotime('-1 hour'));
$oneDayAgo = date('Y-m-d h:i', strtotime('-1 day'));
$oneWeekAgo = date('Y-m-d h:i', strtotime('-1 week'));

$sessionCountNow = getSessionCount($now);
$sessionCount1HourAgo = getSessionCount($oneHourAgo);
$sessionCount1DayAgo = getSessionCount($oneDayAgo);
$sessionCount1WeekAgo = getSessionCount($oneWeekAgo);

if ($sessionCount1HourAgo != 0) {
   $percentageChange1Hour = (($sessionCountNow - $sessionCount1HourAgo) / $sessionCount1HourAgo) * 100;
} else {
   $percentageChange1Hour = 0; // or any desired default value when the division is not possible
}
if ($sessionCount1DayAgo != 0) {
   $percentageChange1Day = (($sessionCountNow - $sessionCount1DayAgo) / $sessionCount1DayAgo) * 100;
} else {
   $percentageChange1Day = 0; // or any desired default value when the division is not possible
}
if ($sessionCount1WeekAgo != 0) {
   $percentageChange1Week = (($sessionCountNow - $sessionCount1WeekAgo) / $sessionCount1WeekAgo) * 100;
} else {
   $percentageChange1Week = 0; // or any desired default value when the division is not possible
}

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
            <div class="col-md-4">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-body">
                     <h4 class="text-uppercase text-black mb-0">Session (Now)</h4>
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="font-size-80 text-black"><?= $sessionCountNow ?></div>
                        <div class="text-left">
                           <p class="m-0 text-uppercase font-size-12">1 Hours Ago</p>
                           <div class="mb-1 text-black"><?= formatCount($sessionCount1HourAgo, $percentageChange1Hour) ?></div>
                           <p class="m-0 text-uppercase font-size-12">1 Day Ago</p>
                           <div class="mb-1 text-black"><?php echo formatCount($sessionCount1DayAgo, $percentageChange1Day); ?></div>
                           <p class="m-0 text-uppercase font-size-12">1 Week Ago</p>
                           <div class="text-black"><?php echo formatCount($sessionCount1WeekAgo, $percentageChange1Week); ?></div>
                        </div>
                     </div>
                     <div id="wave-chart-22"></div>
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
   <script>
      // Create the initial chart options
      var options = {
         chart: {
            type: 'area',
            height: 90,
            sparkline: {
               enabled: true
            }
         },
         series: [{
            data: []
         }],
         fill: {
            opacity: 0.5
         },
         stroke: {
            width: 2,
            curve: 'smooth'
         },
         markers: {
            size: 0
         },
         colors: ['#1abc9c'],
         xaxis: {
            categories: []
         },
         yaxis: {
            min: 0,
            max: 100
         },
         tooltip: {
            theme: 'dark'
         }
      };

      // Create the chart
      var chart = new ApexCharts(document.querySelector("#wave-chart-22"), options);

      // Start the interval to update the chart data
      var interval = setInterval(updateChartData, 400); // Update every 100 milliseconds for smoother animation

      // Function to update the chart data
      function updateChartData() {
         // Retrieve the session count data from the server-side or any appropriate source
         var sessionCountNow = <?php echo $sessionCountNow; ?>;
         var sessionCount1HourAgo = <?php echo $sessionCount1HourAgo; ?>;
         var sessionCount1DayAgo = <?php echo $sessionCount1DayAgo; ?>;
         var sessionCount1WeekAgo = <?php echo $sessionCount1WeekAgo; ?>;

         // Calculate the percentage change
         var percentageChange1Hour = ((sessionCountNow - sessionCount1HourAgo) / sessionCount1HourAgo) * 100;
         var percentageChange1Day = ((sessionCountNow - sessionCount1DayAgo) / sessionCount1DayAgo) * 100;
         var percentageChange1Week = ((sessionCountNow - sessionCount1WeekAgo) / sessionCount1WeekAgo) * 100;

         // Generate the chart data
         var data = [sessionCount1HourAgo, sessionCount1DayAgo, sessionCount1WeekAgo];

         // Set the new data in the chart
         chart.updateSeries([{
            data: data
         }]);

         // Shift the x-axis categories to create a moving effect
         var categories = chart.w.globals.seriesX[0].slice(1);
         categories.push(new Date().toLocaleTimeString()); // Use current time as the new category
         chart.updateOptions({
            xaxis: {
               categories: categories
            }
         });
      }

      // Render the chart
      chart.render();
   </script>
</body>

</html>