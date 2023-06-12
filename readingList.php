<?php
session_start();
require("model.php");

if (isset($_GET['keyword'])) {
   $cari = $_GET['keyword'];
   $bukus = cariDataBuku($cari);
} else {
   $bukus = getData("buku");
}

if (!isSessionStillAlive($_SESSION)) {
   // If the session does not exist in the database, delete the existing session and redirect to the login page
   session_unset();
   session_destroy();
   header("Location: login.php");
   exit();
}


//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}


$current_user = $_SESSION['id_user'];
$readlists = getFavorit($current_user);
$user = getData("users");

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
      <!-- Top Nav Bar -->
   </div>
   <!-- TOP Nav Bar -->
   <?php require("navbar.php") ?>
   <!-- TOP Nav Bar END -->
   <!-- Page Content  -->
   <div id="content-page" class="content-page">
      <div class="container-fluid checkout-content">
         <div class="row">
            <div class="col-sm-12">
               <div class="iq-card">
                  <div class="iq-card-header d-flex justify-content-between iq-border-bottom mb-0">
                     <div class="iq-header-title">
                        <h4 class="card-title">Reading List</h4>
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <ul class="list-inline p-0 m-0">
                        <?php if (!empty($readlists)) : ?>
                           <?php foreach ($readlists as $readlist) : ?>
                              <?php foreach ($bukus as $buku) : ?>
                                 <?php if ($readlist["id_buku"] == $buku["id_buku"]) : ?>
                                    <li class="checkout-product">
                                       <div class="row align-items-center">
                                          <div class="col-sm-3 col-lg-2">
                                             <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                   <a type="button" id="removeFavorite" name="<?= $buku["id_buku"] ?>" class="badge badge-danger"><i class="ri-close-fill"></i></a>
                                                </div>
                                                <div class="col-sm-9 mb-2">
                                                   <span class="checkout-product-img">
                                                      <a href="javascript:void();"><img class="img-fluid rounded" src="resources/cover/<?= $buku["gambar_buku"] ?>" alt=""></a>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-sm-3 col-lg-4">
                                             <div class="checkout-product-details">
                                                <h5><?= $buku["judul_buku"] ?></h5>
                                                <p class="text-success"><?= $buku["penulis"] ?></p>
                                             </div>
                                          </div>
                                          <div class="col-sm-6 col-lg-6">
                                             <div class="row">
                                                <div class="col-sm-8">
                                                </div>
                                                <div class="col-sm-4">
                                                   <a href="book-page.php?id_buku=<?= $buku["id_buku"]; ?>"><button type="submit" class="btn btn-primary view-more">Read</button></a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                 <?php endif ?>
                              <?php endforeach ?>
                           <?php endforeach ?>
                     </ul>
                  <?php else : ?>
                     <div class="alert alert-danger" role="alert">
                        Data Buku Tidak Ditemukan!
                     </div>
                  <?php endif ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   </div>
   <!-- Wrapper END -->
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
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script>
      const buttons = document.querySelectorAll('#removeFavorite .ri-close-fill');

      buttons.forEach(button => {
         button.onclick = () => {
            const id_buku = button.parentNode.getAttribute('name');
            const id_user = <?= $_SESSION["id_user"] ?>;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = () => {
               if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                     swal("Success !", "Book successfully removed to Reading List!", "success");
                     document.cookie = `addedBook_${id_buku}_user_${id_user}=true; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/`;
                     setTimeout(function() {
                        window.location.href = 'readingList.php';
                     }, 1000);;
                  } else {
                     swal("Error !", "Something Went Wrong!", "failed");
                  }
               }
            }
            const params = `id_user=${id_user}&id_buku=${id_buku}`
            xhr.send(params);
         }
      })
   </script>
</body>

</html>