<?php
session_start();
require("model.php");

if (isset($_POST["submit"])) {
   $result = editProfil($_POST);

   if ($result > 0) {
      session_reset();
      $_SESSION["full_name"] = $_POST["full_name"];
      $_SESSION["email"] = $_POST["email"];
      $_SESSION["gender"] = $_POST["gender"];
      $_SESSION["birth_date"] = $_POST["birth_date"];

      if (!empty($_FILES["user_photo"]["name"])) {
         $_SESSION["user_photo"] = $_FILES["user_photo"]["name"];
      }
      echo "
         <script>
            alert('Data berhasil diubah!');
         </script>
      ";
   } else {
      echo "
         <script>
            alert('Data gagal diubah!');
         </script>
      ";
   }
}

//change password
if (isset($_POST["changepass"])) {
   $result = changePassword($_POST);

   if ($result > 0) {
      echo "
         <script>
            alert('Password berhasil diubah!');
         </script>
      ";
   } else {
      echo "
         <script>
            alert('Password gagal diubah!');
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
               <h5 class="mb-0">Edit Profile</h5>
               <nav aria-label="breadcrumb">
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                  </ul>
               </nav>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto navbar-list">
                  <li class="nav-item nav-icon">
                     <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-notification-2-line"></i>
                        <span class="bg-primary dots"></span>
                     </a>
                     <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                           <div class="iq-card-body p-0">
                              <div class="bg-primary p-3">
                                 <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">1</small></h5>
                              </div>
                              <a class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="resources/profile/<?= $user[0]["user_photo"] ?>" alt="">
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
                                             <img class="profile-pic" src="resources/profile/<?= $_SESSION["user_photo"] ?>" alt="<?= $_SESSION['full_name'] ?>">
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
                                          <input type="text" class="form-control" value="<?= isset($_POST['full_name']) ? $_POST['full_name'] : $_SESSION['full_name'] ?>" id="fname" name="full_name">
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
                                 <form method="POST">
                                    <div class="form-group">
                                       <label for="cpass">Current Password:</label>
                                       <input type="Password" class="form-control" id="cpass" name="cpass" value="">
                                    </div>
                                    <div class="form-group">
                                       <label for="npass">New Password:</label>
                                       <input type="Password" class="form-control" id="npass" name="npass" value="">
                                    </div>
                                    <button type="submit" name="changepass" class="btn btn-primary mr-2">Submit</button>
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
               Copyright 2023 <a href="#">BookLib</a> All Rights Reserved.
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
</html>