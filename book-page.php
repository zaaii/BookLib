<?php
session_start();
require("model.php");

$id_buku = !empty($_GET['id_buku']) ? $_GET['id_buku'] : '';
$user = getData("users");

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
   <?php if (!empty($id_buku)) : ?>
      <?php $buku = getData("buku WHERE id_buku = $id_buku")[0]; ?>
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Books Description</h4>
                     </div>
                     <div class="iq-card-body pb-0">
                        <div class="description-contens align-items-top row">
                           <div class="col-md-3">
                              <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                 <div class="iq-card-body p-0">
                                    <div class="row align-items-center">
                                       <div class="col-12">
                                          <ul id="description-slider" class="list-inline p-0 m-0  d-flex align-items-center">
                                             <li>
                                                <a href="javascript:void(0);">
                                                   <img src="resources/cover/<?= $buku["gambar_buku"] ?>" class="img-fluid w-100 rounded" alt="">
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                 <div class="iq-card-body p-0">
                                    <h3 class="mb-3"><?= $buku["judul_buku"] ?></h3>
                                    <span class="text-dark mb-4 pb-4 iq-border-bottom d-block"><?= $buku["deskripsi_buku"] ?></span>
                                    <div class="text-primary mb-4">Author: <span class="text-body"><?= $buku["penulis"] ?></span></div>
                                    <div class="text-primary mb-4">Publisher: <span class="text-body"><?= $buku["penerbit"] ?></span></div>
                                    <div class="text-primary mb-4">Year: <span class="text-body"><?= $buku["tahun_terbit"] ?></span></div>
                                    <div class="mb-4 d-flex align-items-center">
                                       <input type="hidden" name="id_buku" value="<?= $buku["id_buku"] ?>">
                                       <a href="book-pdf.php?id_buku=<?= $buku["id_buku"]; ?>" class="btn btn-primary view-more mr-2">Read</a>
                                    </div>
                                    <div class="mb-3">
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
      </div>
   <?php endif; ?>
   <!-- Wrapper END -->
   <!-- Footer -->
   <?php require("footer.php") ?>
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