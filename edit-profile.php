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
      $message = "Data Profil berhasil diubah!";
      $alertType = "primary";
      $alertIcon = "ri-check-line";
   } else {
      $message = "Data Profil gagal diubah!";
      $alertType = "danger";
      $alertIcon = "ri-close-line";
   }
}

//change password
if (isset($_POST["changepass"])) {
   $result = changePassword($_POST);

   if ($result > 0) {
      $message2 = "Password berhasil diubah!";
      $alertType = "primary";
      $alertIcon = "ri-check-line";
   } else {
      $message2 = "Password Lama Salah, Password gagal diubah!";
      $alertType = "danger";
      $alertIcon = "ri-close-line";
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
      <?php require("navbar.php") ?>
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
                           <?php if (isset($message)) : ?>
                              <div class="alert text-white bg-<?= $alertType ?> mr-4 ml-4" role="alert">
                                 <div class="iq-alert-icon">
                                    <i class="<?= $alertIcon ?>"></i>
                                 </div>
                                 <div class="iq-alert-text"><?= $message ?></div>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                 </button>
                              </div>
                           <?php endif; ?>
                           <div class="iq-card-body">
                              <form method="POST" enctype="multipart/form-data">
                                 <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
                                 <div class="form-group row align-items-center">
                                    <div class="col-md-12">
                                       <div class="profile-img-edit">
                                          <?php if (empty($_SESSION['user_photo'])) : ?>
                                             <img src="resources/profile/default.jpg" class="img-fluid rounded-circle mr-3" alt="user">
                                          <?php else : ?>
                                             <img class="profile-pic" src="resources/profile/<?= $_SESSION["user_photo"] ?>" alt="<?= $_SESSION['full_name'] ?>">
                                          <?php endif; ?>
                                          <div class="p-image">
                                             <i class="ri-pencil-line upload-button"></i>
                                             <input class="file-upload" type="file" name="user_photo" accept="image/*" />
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
                           <?php if (isset($message2)) : ?>
                              <div class="alert text-white bg-<?= $alertType ?> mr-4 ml-4" role="alert">
                                 <div class="iq-alert-icon">
                                    <i class="<?= $alertIcon ?>"></i>
                                 </div>
                                 <div class="iq-alert-text"><?= $message2 ?></div>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                 </button>
                              </div>
                           <?php endif; ?>
                           <?php if (isset($messagePass)) : ?>
                              <div class="alert text-white bg-danger mr-4 ml-4" role="alert">
                                 <div class="iq-alert-icon">
                                    <i class="ri-close-line"></i>
                                 </div>
                                 <div class="iq-alert-text"><?= $messagePass ?></div>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                 </button>
                              </div>
                           <?php endif; ?>
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
<!-- Style Customizer -->
<script src="js/style-customizer.js"></script>
<!-- Chart Custom JavaScript -->
<script src="js/chart-custom.js"></script>
<!-- Custom JavaScript -->
<script src="js/custom.js"></script>
</body>
</html>