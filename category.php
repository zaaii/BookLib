<?php
session_start();
require("model.php");

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

if (isset($_POST['id_user'], $_POST['id_buku'])) {
   $id_user = $_POST['id_user'];
   $id_buku = $_POST['id_buku'];

   // Perform database operations to add/remove favorites based on the current status
   if (isFavorite($id_user, $id_buku)) {
      removeFavorite($id_user, $id_buku);
      http_response_code(200);
   } else {
      addFavorite($id_user, $id_buku);
      http_response_code(200);
   }
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
               <div class="iq-card-transparent mb-0">
                  <div class="d-block text-center">
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
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                     <?php if (isset($_GET['category_id'])) : ?>
                        <div class="iq-header-title">
                           <h4 class="card-title mb-0"><?php echo $category_name; ?></h4>
                        </div>
                     <?php else : ?>
                        <div class="iq-header-title">
                           <h4 class="card-title mb-0">Book List Based Category</h4>
                        </div>
                     <?php endif; ?>
                  </div>
                  <div class="iq-card-body favorites-contens">
                     <?php if (!empty($buku)) : ?>
                        <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                           <?php $i = 1;
                           foreach ($buku as $book) : ?>
                              <li class="col-md-4">
                                 <div class="d-flex align-items-center">
                                    <div class="col-5 p-0 position-relative">
                                       <a href="javascript:void();">
                                          <img src="resources/cover/<?= $book["gambar_buku"] ?>" class="img-fluid rounded w-100" alt="<?= $book["judul_buku"] ?>">
                                       </a>
                                    </div>
                                    <div class="col-7">
                                       <h5 class="mb-2"><?= $book["judul_buku"] ?></h5>
                                       <p class="mb-1">Author : <?= $book["penulis"] ?></p>
                                       <div class="iq-product-action mb-2">
                                          <a type="button" class="addFavorite" name="<?= $book["id_buku"] ?>"><i class="ri-heart-line"></i></a>
                                       </div>
                                       <a href="book-page.php?id_buku=<?= $book["id_buku"]; ?>" class="text-dark">Read Now<i class="ri-arrow-right-s-line"></i></a>
                                    </div>
                                 </div>
                              </li>
                           <?php $i++;
                           endforeach; ?>
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
                        swal("Success !", "Buku berhasil ditambahkan ke Reading List!", "success");
                        document.cookie = `addedBook_${id_buku}_user_${id_user}=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/`;
                     } else {
                        button.classList.add("ri-heart-line");
                        swal("Success !", "Buku berhasil dihapus ke Reading List!", "success");
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