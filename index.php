<?php
session_start();
require("model.php");

if (isset($_GET['keyword'])) {
   $cari = $_GET['keyword'];
   $bukus = cariDataBuku($cari);
   } else {
   $bukus = getData("buku");
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
      
//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
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
      <?php require("sidebar.php")?>
   </div>
      <!-- TOP Nav Bar -->
      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
               <div class="iq-menu-bt d-flex align-items-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="las la-bars"></i></div>
                  </div>
                  <div class="iq-navbar-logo d-flex justify-content-between">
                     <a href="index.php" class="header-logo">
                        <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
                        <div class="logo-title">
                           <span class="text-primary text-uppercase">BookLib</span>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="navbar-breadcrumb">
                  <h5 class="mb-0">Home</h5>
                  <nav aria-label="breadcrumb">
                     <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home Page</li>
                     </ul>
                  </nav>
               </div>
               <div class="iq-search-bar">
                  <form action="" class="searchbox" id="searchForm" method="get">
                     <input type="text" name="keyword" class="text search-input"  placeholder="Search Here...">
                     <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                  </form>
               </div>
               <button class="navbar-toggler" type="submit" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto navbar-list">
                     <li class="nav-item nav-icon search-content">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                           <i class="ri-search-line"></i>
                        </a>
                        <form action="" class="search-box p-0" id="searchForm" method="get">
                           <input type="text" name="keyword" class="text search-input"  placeholder="Type here to search...">
                           <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                        </form>
                     </li>
                     <li class="nav-item nav-icon">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                           <i class="ri-notification-2-line"></i>
                           <span class="bg-primary dots"></span>
                        </a>
                        <div class="iq-sub-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>
                                 </div>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">System</h6>
                                          <small class="float-right font-size-12">Just Now</small>
                                          <p class="mb-0">Welcome to BookLib</p>
                                       </div>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="line-height pt-3">
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                           <img src="images/user/1.jpg" class="img-fluid rounded-circle mr-3" alt="user">
                           <div class="caption">
                              <h6 class="mb-1 line-height"><?= $_SESSION['full_name']; ?>
                           </h6>
                              <p class="mb-0 text-primary"><?= $_SESSION['role'] ?></p>
                           </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello <?= $_SESSION['full_name'] ?></h5>
                                    <span class="text-white font-size-12"><?= $_SESSION['email'] ?></span>
                                 </div>
                                 <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile</h6>
                                          <p class="mb-0 font-size-12">Modify your personal details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="logout.php" role="button">Sign Out<i class="ri-login-box-line ml-2"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
      </div>
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
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                           <a href="category.html" class="btn btn-sm btn-primary view-more">View More</a>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <?php if(!empty($bukus)): ?>
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
   </div>
   </div>
   <!-- Wrapper END -->
   <!-- Footer -->
   <footer class="iq-footer">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6 text-right">
               Copyright 2023 <a href="#">BookLib</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>
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
   <script>
      const buttons = document.querySelectorAll(".addFavorite .ri-heart-line");

      buttons.forEach(button =>{
         button.onclick = ()=>{
            const id_buku = button.parentNode.getAttribute("name");
            const id_user = <?php echo $_SESSION["id_user"]; ?>;

         let xhr = new XMLHttpRequest();
         xhr.open('POST', 'index.php', true);
         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

         xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
               if(xhr.status === 200){
                  button.classList.remove("ri-heart-line");
                  button.classList.toggle("ri-heart-fill");
                  button.classList.toggle("text-danger");

                  if(button.classList.contains("ri-heart-fill")){
                     alert("Buku berhasil ditambahkan ke Reading List!");
                     document.cookie = `addedBook_${id_buku}=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/`;
                     location.reload();
                  } else{
                     button.classList.add("ri-heart-line");
                     alert("Buku berhasil dihapus dari Reading List!");
                     document.cookie = `addedBook_${id_buku}=true; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/`;
                     location.reload();
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
    const addedBookCookie = `addedBook_${id_buku}=true`;
    if (document.cookie.includes(addedBookCookie)) {
        button.classList.remove("ri-heart-line");
        button.classList.add("ri-heart-fill", "text-danger");
    }
      });
</script>
</body>
</html>