<?php

session_start();
require("model.php");

$user = getData("users");
// Ambil daftar kategori dari database
$categories = getData("categories");

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

$id_buku = !empty($_GET['id_buku']) ? $_GET['id_buku'] : '';
//memeriksa apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
   if (insertDataBuku($_POST) > 0) {
      $message = "Data buku berhasil ditambahkan";
      $alertType = "primary";
      $alertIcon = "ri-check-line";
   } else {
      $message = "Data buku gagal ditambahkan";
      $alertType = "danger";
      $alertIcon = "ri-close-line";
   }
}
//memeriksa apakah tombol ubah sudah ditekan atau belum
if (isset($_POST["ubah"])) {
   if (updateDataBuku($_POST) > 0) {
      $message = "Data buku berhasil diubah";
      $alertType = "primary";
      $alertIcon = "ri-check-line";
   } else {
      $message = "Data buku gagal diubah";
      $alertType = "danger";
      $alertIcon = "ri-close-line";
   }
}

// Check Role user
checkRole($_SESSION);

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
                     <?php if (empty($id_buku)) : ?>
                        <div class="iq-header-title">
                           <h4 class="card-title">Add Books</h4>
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
                              <input type="file" class="custom-file-input" accept="image/png, image/jpeg, image/webp" name="gambar_buku" id="gambar_buku" required>
                              <label class="custom-file-label">Choose file</label>
                           </div>
                        </div>
                        <div class="form-group">
                           <label>Book pdf:</label>
                           <div class="custom-file">
                              <input type="file" class="custom-file-input" accept="application/pdf" name="pdf_buku" id="pdf_buku" required>
                              <label class="custom-file-label">Choose file</label>
                           </div>
                        </div>
                        <div class="form-group">
                           <label>Book Description:</label>
                           <textarea class="form-control" rows="4" name="deskripsi_buku" id="deskripsi_buku" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                           <label>Category Book</label>
                           <select class="form-control" name="category_ids[]" id="" required multiple="multiple">
                           <option selected="" disabled="">Select your category book</option>
                              <?php
                              $categories = $koneksi->query("SELECT * FROM categories");
                              while ($row = $categories->fetch_assoc()) :
                              ?>
                                 <option value="<?php echo $row['id_category'] ?>" <?php echo isset($category_ids) && !empty($category_ids) &&  in_array($row['id_category'], explode(',', $category_ids)) ? 'selected' : '' ?>><?php echo ucwords($row['category_name']) ?></option>
                              <?php endwhile; ?>
                           </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <a href="admin-books.php" class="btn btn-danger">Back</a>
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
                        <input type="file" name="gambar_buku" id="gambar_buku" class="custom-file-input" accept="image/png, image/jpeg, image/webp">
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
                  <div class="form-group">
                           <label>Category Book</label>
                           <select class="custom-select custom-select-sm select2" name="category_ids[]" id="category_ids" required multiple="multiple">
                           <option value=""></option>
                              <?php
                              $categories = $koneksi->query("SELECT * FROM categories");
                              while ($row = $categories->fetch_assoc()) :
                              ?>
                                 <option value="<?php echo $row['id_category'] ?>" <?php echo isset($category_ids) && !empty($category_ids) &&  in_array($row['id_category'], explode(',', $category_ids)) ? 'selected' : '' ?>><?php echo ucwords($row['category_name']) ?></option>
                              <?php endwhile; ?>
                           </select>
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

<!-- Mirrored from templates.iqonic.design/booksto/html/admin-add-book.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Apr 2023 04:59:25 GMT -->

</html>

<script>
	$('.select2').select2({
		placeholder:"Please Select Here",
		width:'100%'
	})
</script>