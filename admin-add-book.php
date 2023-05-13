<?php
require("Model.php");
$id_buku = !empty($_GET['id_buku']) ? $_GET['id_buku'] : '';
//memeriksa apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
   if (insertDataBuku($_POST) > 0) {
      echo "
      <script>
      alert('Data berhasil ditambahkan');
      document.location.href = 'admin-books.php';
      </script>
      ";
   } else {
      echo "
      <script>
      alert('Data gagal ditambahkan');
      document.location.href = 'admin-books.php';
      </script>
      ";
   }
}
//memeriksa apakah tombol ubah sudah ditekan atau belum
if (isset($_POST["ubah"])) {
   if (updateDataBuku($_POST) > 0) {
      echo "
      <script>
      alert('Data berhasil diubah');
      document.location.href = 'admin-books.php';
      </script>
      ";
   } else {
      echo "
      <script>
      alert('Data gagal diubah');
      document.location.href = 'admin-books.php';
      </script>
      ";
   }
}
?>
<!doctype html>
<html lang="en">

<!-- Mirrored from templates.iqonic.design/booksto/html/admin-add-book.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:59:25 GMT -->

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Zabooks</title>
   <!-- Favicon -->
   <link rel="shortcut icon" href="images/favicon.ico" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
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
   <div class="iq-top-navbar">
      <div class="iq-navbar-custom">
         <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
               <div class="wrapper-menu">
                  <div class="main-circle"><i class="las la-bars"></i></div>
               </div>
               <div class="iq-navbar-logo d-flex justify-content-between">
                  <a href="index-2.html" class="header-logo">
                     <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
                     <div class="logo-title">
                        <span class="text-primary text-uppercase">Booksto</span>
                     </div>
                  </a>
               </div>
            </div>
            <div class="navbar-breadcrumb">
               <h4 class="mb-0 text-dark">Dashboard</h4>
               <p class="mb-0"><span class="text-primary">Hi there,</span> Welcome back Your profile</p>
            </div>
            <div class="iq-search-bar">
               <form action="#" class="searchbox">
                  <input type="text" class="text search-input" placeholder="Search Here...">
                  <a class="search-link" href="#"><i class="ri-search-line"></i></a>
               </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
               <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto navbar-list">
                  <li class="nav-item nav-icon search-content">
                     <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-search-line"></i>
                     </a>
                     <form action="#" class="search-box p-0">
                        <input type="text" class="text search-input" placeholder="Type here to search...">
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
                                       <h6 class="mb-0 ">Emma Watson Barry</h6>
                                       <small class="float-right font-size-12">Just Now</small>
                                       <p class="mb-0">95 MB</p>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">New customer is join</h6>
                                       <small class="float-right font-size-12">5 days ago</small>
                                       <p class="mb-0">Cyst Barry</p>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/03.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Two customer is left</h6>
                                       <small class="float-right font-size-12">2 days ago</small>
                                       <p class="mb-0">Cyst Barry</p>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/04.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">New Mail from Fenny</h6>
                                       <small class="float-right font-size-12">3 days ago</small>
                                       <p class="mb-0">Cyst Barry</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="nav-item nav-icon dropdown">
                     <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-mail-line"></i>
                        <span class="bg-primary dots"></span>
                     </a>
                     <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                           <div class="iq-card-body p-0 ">
                              <div class="bg-primary p-3">
                                 <h5 class="mb-0 text-white">All Messages<small class="badge  badge-light float-right pt-1">5</small></h5>
                              </div>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Barry Emma Watson</h6>
                                       <small class="float-left font-size-12">13 Jun</small>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                       <small class="float-left font-size-12">20 Apr</small>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/03.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Why do we use it?</h6>
                                       <small class="float-left font-size-12">30 Jun</small>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/04.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Variations Passages</h6>
                                       <small class="float-left font-size-12">12 Sep</small>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="avatar-40 rounded" src="images/user/05.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                       <small class="float-left font-size-12">5 Dec</small>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="nav-item nav-icon dropdown">
                     <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span class="badge badge-danger count-cart rounded-circle">4</span>
                     </a>
                     <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                           <div class="iq-card-body p-0 toggle-cart-info">
                              <div class="bg-primary p-3">
                                 <h5 class="mb-0 text-white">All Carts<small class="badge  badge-light float-right pt-1">4</small></h5>
                              </div>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="rounded" src="images/cart/01.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Night People book</h6>
                                       <p class="mb-0">$32</p>
                                    </div>
                                    <div class="float-right font-size-24 text-danger"><i class="ri-close-fill"></i></div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="rounded" src="images/cart/02.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">The Sin Eater Book</h6>
                                       <p class="mb-0">$40</p>
                                    </div>
                                    <div class="float-right font-size-24 text-danger"><i class="ri-close-fill"></i></div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="rounded" src="images/cart/03.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">the Orange Tree</h6>
                                       <p class="mb-0">$30</p>
                                    </div>
                                    <div class="float-right font-size-24 text-danger"><i class="ri-close-fill"></i></div>
                                 </div>
                              </a>
                              <a href="#" class="iq-sub-card">
                                 <div class="media align-items-center">
                                    <div class="">
                                       <img class="rounded" src="images/cart/04.jpg" alt="">
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Harsh Reality book</h6>
                                       <p class="mb-0">$25</p>
                                    </div>
                                    <div class="float-right font-size-24 text-danger"><i class="ri-close-fill"></i></div>
                                 </div>
                              </a>
                              <div class="d-flex align-items-center text-center p-3">
                                 <a class="btn btn-primary mr-2 iq-sign-btn" href="#" role="button">View Cart</a>
                                 <a class="btn btn-primary iq-sign-btn" href="#" role="button">Shop now</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="line-height pt-3">
                     <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <img src="images/user/1.jpg" class="img-fluid rounded-circle mr-3" alt="user">
                        <div class="caption">
                           <h6 class="mb-1 line-height">Barry Tech</h6>
                           <p class="mb-0 text-primary">$20.32</p>
                        </div>
                     </a>
                     <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                           <div class="iq-card-body p-0 ">
                              <div class="bg-primary p-3">
                                 <h5 class="mb-0 text-white line-height">Hello Barry Tech</h5>
                                 <span class="text-white font-size-12">Available</span>
                              </div>
                              <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                 <div class="media align-items-center">
                                    <div class="rounded iq-card-icon iq-bg-primary">
                                       <i class="ri-file-user-line"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">My Profile</h6>
                                       <p class="mb-0 font-size-12">View personal profile details.</p>
                                    </div>
                                 </div>
                              </a>
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
                              <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                 <div class="media align-items-center">
                                    <div class="rounded iq-card-icon iq-bg-primary">
                                       <i class="ri-account-box-line"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Account settings</h6>
                                       <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                    </div>
                                 </div>
                              </a>
                              <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                 <div class="media align-items-center">
                                    <div class="rounded iq-card-icon iq-bg-primary">
                                       <i class="ri-lock-line"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                       <h6 class="mb-0 ">Privacy Settings</h6>
                                       <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                    </div>
                                 </div>
                              </a>
                              <div class="d-inline-block w-100 text-center p-3">
                                 <a class="bg-primary iq-sign-btn" href="sign-in.html" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
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
            <div class="col-sm-12">
               <div class="iq-card">
                  <div class="iq-card-header d-flex justify-content-between">
                     <?php if (empty($id_buku)) : ?>
                     <div class="iq-header-title">
                        <h4 class="card-title">Add Books</h4>
                     </div>
                  </div>
                     <div class="iq-card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                           <div class="form-group">
                              <label>Book Name:</label>
                              <input type="text" name="judul_buku" id="judul_buku" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label>Book Author:</label>
                              <input type="text" name="penulis" id="penulis" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label>Book Publisher:</label>
                              <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label>Book Year:</label>
                              <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label>Book Image:</label>
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" accept="image/png, image/jpeg" name="gambar_buku" id="gambar_buku">
                                 <label class="custom-file-label">Choose file</label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Book pdf:</label>
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" accept="application/pdf" name="pdf_buku" id="pdf_buku">
                                 <label class="custom-file-label">Choose file</label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Book Description:</label>
                              <textarea class="form-control" rows="4" name="deskripsi_buku" id="deskripsi_buku" class="form-control" required></textarea>
                           </div>
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                           <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                     </div>
               </div>
            <?php endif; ?>
            <?php if (!empty($id_buku)) : ?>
               <?php $buku = getData("buku WHERE id_buku = $id_buku")[0]; ?>
               <div class="iq-header-title">
                        <h4 class="card-title">Update Books</h4>
                     </div>
                  </div>
               <div class="iq-card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="id_buku" value="<?= $buku["id_buku"] ?>">
                     <div class="form-group">
                        <label>Book Name:</label>
                        <input type="text" name="judul_buku" id="judul_buku" class="form-control" required value="<?= $buku["judul_buku"] ?>">
                     </div>
                     <div class="form-group">
                        <label>Book Author:</label>
                        <input type="text" name="penulis" id="penulis" class="form-control" required value="<?= $buku["penulis"] ?>">
                     </div>
                     <div class="form-group">
                        <label>Book Publisher:</label>
                        <input type="text" name="penerbit" id="penerbit" class="form-control" required value="<?= $buku["penerbit"] ?>">
                     </div>
                     <div class="form-group">
                        <label>Book Year:</label>
                        <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" required value="<?= $buku["tahun_terbit"] ?>">
                     </div>
                     <div class="form-group">
                        <label>Book Image:</label>
                        <span><?= $buku["gambar_buku"] ?></span>
                        <div class="custom-file">
                           <input type="file" name="gambar_buku" id="gambar_buku" class="custom-file-input" accept="image/png, image/jpeg">
                           <label class="custom-file-label">Choose file</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Book pdf:</label>
                        <span><?= $buku["pdf_buku"] ?></span>
                        <div class="custom-file">
                           <input type="file" name="pdf_buku" id="pdf_buku" class="custom-file-input" accept="application/pdf">
                           <label class="custom-file-label">Choose file</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Book Description:</label>
                        <input type="text" name="deskripsi_buku" id="deskripsi_buku" class="form-control" required value="<?= $buku["deskripsi_buku"] ?>">
                     </div>
                     <button type="submit" class="btn btn-primary" name="ubah">Change</button>
                     <a href="admin-books.php" class="btn btn-danger">Back</a>
                  </form>
               </div>
            <?php endif; ?>
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
            <div class="col-lg-6">
               <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
               </ul>
            </div>
            <div class="col-lg-6 text-right">
               Copyright 2020 <a href="#">Booksto</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>
   <!-- Footer END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery.dataTables.min.js"></script>
   <script src="js/dataTables.bootstrap4.min.js"></script>
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

<!-- Mirrored from templates.iqonic.design/booksto/html/admin-add-book.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:59:25 GMT -->

</html>