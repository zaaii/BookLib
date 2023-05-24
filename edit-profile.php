<?php
session_start();
require("model.php");

// cek apakah tombol submit edit profil sudah ditekan atau belum dan update value saat sudah berhasil edit

if (isset($_POST["submit"])) {
   if (editProfil($_POST) > 0) {
      
      echo "
         <script>
            alert('Data berhasil diubah!');
            document.location.href = 'profile.php';
         </script>
      ";
   } else {
      echo "
         <script>
            alert('Data gagal diubah!');
            document.location.href = 'profile.php';
         </script>
      ";
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
<body class="sidebar-main-active right-column-fixed">
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   <!-- Wrapper Start -->
   <div class="wrapper">
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
                     <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Home Page</li>
                  </ul>
               </nav>
            </div>
            <div class="iq-search-bar">
               <form action="" class="searchbox" id="searchForm" method="get">
                  <input type="text" name="keyword" class="text search-input" placeholder="Search Here...">
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
                        <input type="text" name="keyword" class="text search-input" placeholder="Type here to search...">
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
                        <img src="resources/profile/<?= $_SESSION['user_photo'] ?>" class="img-fluid rounded-circle mr-3" alt="user">
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
                              <a href="edit-profile.php" class="iq-sub-card iq-bg-primary-hover">
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
                  <div class="iq-card">
                     <div class="iq-card-body p-0">
                        <div class="iq-edit-list">
                           <ul class="iq-edit-profile d-flex nav nav-pills">
                              <li class="col-md-3 p-0">
                                 <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                    Personal Information
                                 </a>
                              </li>
                              <li class="col-md-3 p-0">
                                 <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                    Change Password
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="iq-edit-list-data">
                     <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Personal Information</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <form method="POST" enctype="multipart/form-data">
                                 <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
                                    <div class="form-group row align-items-center">
                                       <div class="col-md-12">
                                          <div class="profile-img-edit">
                                             <img class="profile-pic" src="resources/profile/<?= $_SESSION['user_photo'] ?>" alt="<?= $_SESSION['full_name'] ?>">
                                             <div class="p-image">
                                                <i class="ri-pencil-line upload-button"></i>
                                                <input class="file-upload" type="file" name="user_photo" accept="image/*"/>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class=" row align-items-center">
                                       <div class="form-group col-sm-6">
                                          <label for="fname">Full Name:</label>
                                          <input type="text" class="form-control" id="fname" name="full_name"><?= isset($_POST['full_name']) ? $_POST['full_name'] : $_SESSION['full_name'] ?>
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="email">Email :</label>
                                          <input type="text" class="form-control" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'] ?>">
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label class="d-block">Gender:</label>
                                          <div class="custom-control custom-radio custom-control-inline">
                                             <input type="radio" name="gender" id="male" value="male" class="custom-control-input" <?= ($_SESSION['gender'] == 'male') ? 'checked' : '' ?>>
                                             <label class="custom-control-label" for="male"> Male </label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                             <input type="radio" name="gender" id="female" value="female" class="custom-control-input" <?= ($_SESSION['gender'] == 'female') ? 'checked' : '' ?>>
                                             <label class="custom-control-label" for="female"> Female </label>
                                          </div>
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="dob">Date Of Birth:</label>
                                          <input type="date" class="form-control" name="birth_date" id="dob" value="<?= isset($_POST['birth_date']) ? $_POST['birth_date'] : $_SESSION['birth_date'] ?>">
                                       </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Reset</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Change Password</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <form>
                                    <div class="form-group">
                                       <label for="cpass">Current Password:</label>
                                       <a href="javascripe:void();" class="float-right">Forgot Password</a>
                                       <input type="Password" class="form-control" id="cpass" value="">
                                    </div>
                                    <div class="form-group">
                                       <label for="npass">New Password:</label>
                                       <input type="Password" class="form-control" id="npass" value="">
                                    </div>
                                    <div class="form-group">
                                       <label for="vpass">Verify Password:</label>
                                       <input type="Password" class="form-control" id="vpass" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Email and SMS</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <form>
                                    <div class="form-group row align-items-center">
                                       <label class="col-8 col-md-3" for="emailnotification">Email Notification:</label>
                                       <div class="col-4 col-md-9 custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="emailnotification" checked="">
                                          <label class="custom-control-label" for="emailnotification"></label>
                                       </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                       <label class="col-8 col-md-3" for="smsnotification">SMS Notification:</label>
                                       <div class="col-4 col-md-9 custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="smsnotification" checked="">
                                          <label class="custom-control-label" for="smsnotification"></label>
                                       </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                       <label class="col-md-3" for="npass">When To Email</label>
                                       <div class="col-md-9">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="email01">
                                             <label class="custom-control-label" for="email01">You have new notifications.</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="email02">
                                             <label class="custom-control-label" for="email02">You're sent a direct message</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="email03" checked="">
                                             <label class="custom-control-label" for="email03">Someone adds you as a connection</label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                       <label class="col-md-3" for="npass">When To Escalate Emails</label>
                                       <div class="col-md-9">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="email04">
                                             <label class="custom-control-label" for="email04"> Upon new order.</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="email05">
                                             <label class="custom-control-label" for="email05"> New membership approval</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="email06" checked="">
                                             <label class="custom-control-label" for="email06"> Member registration</label>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Manage Contact</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <form>
                                    <div class="form-group">
                                       <label for="cno">Contact Number:</label>
                                       <input type="text" class="form-control" id="cno" value="001 2536 123 458">
                                    </div>
                                    <div class="form-group">
                                       <label for="email">Email:</label>
                                       <input type="text" class="form-control" id="email" value="Barryjone@demo.com">
                                    </div>
                                    <div class="form-group">
                                       <label for="url">Url:</label>
                                       <input type="text" class="form-control" id="url" value="https://getbootstrap.com/">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                 </form>
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
   <footer class="iq-footer">
      <div class="container-fluid">
         <div class="row">
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
<!-- Style Customizer -->
<script src="js/style-customizer.js"></script>
<!-- Chart Custom JavaScript -->
<script src="js/chart-custom.js"></script>
<!-- Custom JavaScript -->
<script src="js/custom.js"></script>
</body>

<!-- Mirrored from templates.iqonic.design/booksto/html/profile-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:58:42 GMT -->
</html>