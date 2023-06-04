<?php
session_start();
require("model.php");

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

$id_category = !empty($_GET['id_category']) ? $_GET['id_category'] : '';
//memeriksa apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
   if (insertDataCategory($_POST) > 0) {
      echo "
      <script>
      alert('Data berhasil ditambahkan');
      document.location.href = 'admin-category.php';
      </script>
      ";
   } else {
      echo "
      <script>
      alert('Data gagal ditambahkan');
      document.location.href = 'admin-category.php';
      </script>
      ";
   }
}
//memeriksa apakah tombol ubah sudah ditekan atau belum
if (isset($_POST["ubah"])) {
   if (updateDataCategory($_POST) > 0) {
      echo "
      <script>
      alert('Data berhasil diubah');
      document.location.href = 'admin-category.php';
      </script>
      ";
   } else {
      echo "
      <script>
      alert('Data gagal diubah');
      document.location.href = 'admin-category.php';
      </script>
      ";
   }
}

// Check Role user
checkRole($_SESSION);

?>
<!doctype html>
<html lang="en">

<!-- Mirrored from templates.iqonic.design/booksto/html/admin-add-category.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:59:25 GMT -->

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Booksto - Responsive Bootstrap 4 Admin Dashboard Template</title>
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
   <?php require("navbar.php") ?>
   <!-- TOP Nav Bar END -->
   <!-- Page Content  -->
   <div id="content-page" class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="iq-card">
                  <div class="iq-card-header d-flex justify-content-between">
                     <?php if (empty($id_category)) : ?>
                        <div class="iq-header-title">
                           <h4 class="card-title">Add Categories</h4>
                        </div>
                  </div>
                  <div class="iq-card-body">
                     <form action="" method="post">
                        <div class="form-group">
                           <label>Category Name:</label>
                           <input type="text" name="category_name" id="category_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label>Category Description:</label>
                           <textarea class="form-control" rows="4" name="category_description" id="category_description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <a href="admin-category.php" class="btn btn-danger">Back</a>
                     </form>
                  </div>
               </div>
            </div>
         <?php endif; ?>
         <?php if (!empty($id_category)) : ?>
            <?php $category = getData("category WHERE id_category = $id_category")[0]; ?>
            <div class="iq-header-title">
               <h4 class="card-title">Add Categories</h4>
            </div>
         </div>
         <div class="iq-card-body">
            <form action="" method="post">
            <input type="hidden" name="id_category" value="<?= $category["id_category"] ?>">
               <div class="form-group">
                  <label>Category Name:</label>
                  <input type="text" name="category_name" id="category_name" class="form-control" required value="<?= $category["category_name"] ?>">
               </div>
               <div class="form-group">
                  <label>Category Description:</label>
                  <input class="form-control" rows="4" name="category_description" id="category_description" value="<?= $category["category_description"] ?>"></input>
               </div>
               <button type="submit" class="btn btn-primary" name="ubah">Change</button>
               <a href="admin-category.php" class="btn btn-danger">Cancel</a>
            </form>
         </div>
      </div>
   <?php endif; ?>
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

<!-- Mirrored from templates.iqonic.design/booksto/html/admin-add-category.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:59:25 GMT -->

</html>