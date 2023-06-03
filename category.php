<?php
session_start();
require("model.php");

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

$user = getData("users");
// Check if sesion user still exists
if (isSessionStillAlive($_SESSION) == false) {
   // jika session is already not exist in database delete existing session
   $_SESSION = [];
   header("Location:login.php");
}

// Mendapatkan daftar kategori
$query_categories = "SELECT * FROM categories";
$result_categories = mysqli_query($koneksi, $query_categories);
$categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC);

// Mendapatkan buku berdasarkan kategori
// Mendapatkan buku berdasarkan kategori
if (isset($_GET['category_id'])) {
   $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

   if ($category_id > 0) {
      $query_buku = "SELECT * FROM buku WHERE FIND_IN_SET($category_id, category_ids)";
      $result_buku = mysqli_query($koneksi, $query_buku);
      $buku = mysqli_fetch_all($result_buku, MYSQLI_ASSOC);
   } else {
      // Handle the case when category_id is not a valid value (less than or equal to 0)
      // For example, display an error message or redirect to a different page
      echo "Invalid category ID.";
   }
}

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

// Mendapatkan nama kategori berdasarkan kategori yang dipilih
$category_name = '';
if (!empty($category_id)) {
   foreach ($categories as $category) {
      if ($category['id_category'] == $category_id) {
         $category_name = $category['category_name'];
         break;
      }
   }
} else {
   // Tidak ada kategori yang dipilih, tampilkan pesan atau lakukan tindakan lain
   echo "Silakan pilih kategori buku.";
}

?>
<!doctype html>
<html lang="en">

<!-- Mirrored from templates.iqonic.design/booksto/html/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:58:12 GMT -->

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Booksto - Responsive Bootstrap 4 Admin Dashboard Template</title>
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
               <div class="iq-card-transparent mb-0">
                  <div class="d-block text-center">
                     <h2 class="mb-3">Filter by Book Category</h2>
                     <div class="w-100 iq-search-filter">
                        <ul class="list-inline p-0 m-0 row justify-content-center search-menu-options">
                           <li class="search-menu-opt">
                              <div class="iq-dropdown">
                                 <div class="form-group mb-0">
                                    <form action="" method="GET">
                                       <select class="form-control form-search-control bg-white border-0" name="category_id">
                                          <option value="" selected>Select Category Book</option>
                                          <?php foreach ($categories as $category) : ?>
                                             <option value="<?php echo $category['id_category']; ?>" <?php if ($category_id == $category['id_category']) echo 'selected'; ?>><?php echo $category['category_name']; ?></option>
                                          <?php endforeach; ?>
                                       </select>
                                 </div>
                              </div>
                           </li>
                           <li class="search-menu-opt">
                              <div class="iq-search-bar search-book d-flex align-items-center">
                                 <button type="submit" class="btn btn-primary search-data ml-2">Show</button>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <?php if (isset($buku)) : ?>
                  <?php if (empty($buku)) : ?>
                     <p>Tidak ada buku dalam kategori ini.</p>
                  <?php else : ?>
                     <div class="col-lg-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                              <div class="iq-header-title">
                                 <h2><?php echo $category_name; ?></h2>
                              </div>
                           </div>
                           <div class="iq-card-body similar-contens">
                              <ul id="similar-slider" class="list-inline p-0 mb-0 row">
                                 <?php foreach ($buku as $book) : ?>
                                    <li class="col-md-12">
                                       <div class="d-flex align-items-center">
                                          <div class="col-5 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="resources/cover/<?= $book["gambar_buku"] ?>" alt="<?= $book["judul_buku"] ?>"></a>
                                             <div class="view-book">
                                                <input type="hidden" name="id_buku" value="<?= $book["id_buku"] ?>">
                                                <a href="book-page.php?id_buku=<?= $book["id_buku"]; ?>" class="btn btn-sm btn-white">View Book</a>
                                             </div>
                                          </div>
                                          <div class="col-7">
                                             <div class="mb-2">
                                                <h6 class="mb-1"><?php echo $book['judul_buku'] ?></h6>
                                                <p class="font-size-13 line-height mb-1"><?php echo $book['penulis'] ?></p>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                 <?php endforeach; ?>
                              <?php endif; ?>
                           <?php endif; ?>
                              </ul>
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

<!-- Mirrored from templates.iqonic.design/booksto/html/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:58:32 GMT -->

</html>