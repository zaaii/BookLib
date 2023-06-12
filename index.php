<?php
session_start();
require("model.php");
// 
if (isset($_GET['keyword'])) {
   $cari = $_GET['keyword'];
   $bukus = cariDataBuku($cari);
} else {
   $bukus = getData("buku");
}

if (isset($_POST['id_user'], $_POST['id_buku'])) {
   $id_user = $_POST['id_user'];
   $id_buku = $_POST['id_buku'];

   
   if (isFavorite($id_user, $id_buku)) {
      removeFavorite($id_user, $id_buku);
      http_response_code(200);
   } else {
      addFavorite($id_user, $id_buku);
      http_response_code(200);
   }
}

$user = getData("users");

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

if (!isSessionStillAlive($_SESSION)) {
   // If the session does not exist in the database, delete the existing session and redirect to the login page
   session_unset();
   session_destroy();
   header("Location: login.php");
   exit();
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
   <div id="content-page" class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                     <div class="iq-header-title">
                        <h4 class="card-title mb-0">Browse Books</h4>
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <?php if (!empty($bukus)) : ?>
                        <div class="row">
                           <?php $i = 1; ?>
                           <?php foreach ($bukus as $buku) : ?>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="resources/cover/<?= $buku["gambar_buku"] ?>" alt="<?= $buku["judul_buku"] ?>"></a>
                                             <div class="view-book">
                                                <input type="hidden" name="id_buku" value="<?= $buku["id_buku"] ?>">
                                                <a href="book-page.php?id_buku=<?= $buku["id_buku"]; ?>" class="btn btn-sm btn-white">View Book</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1"><?= $buku["judul_buku"] ?></h6>
                                                <p class="font-size-13 line-height mb-1"><?= $buku["penulis"] ?></p>
                                             </div>
                                             <div class="iq-product-action">
                                                <a type="button" class="addFavorite" name="<?= $buku["id_buku"] ?>"><i class="ri-heart-line"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php $i++; ?>
                           <?php endforeach ?>
                        </div>
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
   <?php if (isset($message)) : ?>
      <div class="toast-container">
         <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
               <svg class="bd-placeholder-img rounded mr-2" width="50" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                  <rect width="100%" height="100%" fill="#007aff"></rect>
               </svg>
               <strong class="mr-auto">BookLib System</strong>
               <small class="text-muted">just now</small>
               <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="toast-body">
               <?= $message; ?>
            </div>
         </div>
      </div>
   <?php endif; ?>
   </div>
   </div>
   </div>
   <!-- Wrapper END -->
   <!-- Footer -->
   <?php require("footer.php") ?>
   <!-- Footer END -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      const buttons = document.querySelectorAll(".addFavorite .ri-heart-line");

      buttons.forEach(button => {
         button.onclick = () => {
            const id_buku = button.parentNode.getAttribute("name");
            const id_user = <?php echo $_SESSION["id_user"]; ?>;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = () => {
               if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                     button.classList.remove("ri-heart-line");
                     button.classList.toggle("ri-heart-fill");
                     button.classList.toggle("text-danger");

                     if (button.classList.contains("ri-heart-fill")) {
                        swal("Success !", "Book successfully added to Reading List!", "success");
                        document.cookie = `addedBook_${id_buku}_user_${id_user}=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/`;
                     } else {
                        button.classList.add("ri-heart-line");
                        swal("Success !", "Book successfully removed to Reading List!", "success");
                        document.cookie = `addedBook_${id_buku}_user_${id_user}=true; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/`;
                     }
                  } else {
                     alert("Error: " + xhr.status);
                  }
               }
            }
            const params = `id_user=${id_user}&id_buku=${id_buku}`;
            xhr.send(params);
         }
         // Check if the book is already added by reading the cookie
         const id_buku = button.parentNode.getAttribute("name");
         const id_user = <?php echo $_SESSION["id_user"]; ?>;
         const addedBookCookie = `addedBook_${id_buku}_user_${id_user}=true`;
         if (document.cookie.includes(addedBookCookie)) {
            button.classList.remove("ri-heart-line");
            button.classList.add("ri-heart-fill", "text-danger");
         }
      });
   </script>
</body>
</html>