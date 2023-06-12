<?php
session_start();
require("model.php");

//cek apakah user sudah login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

if (isset($_GET['book_id'])) {
   $book_id = $_GET['book_id'];
   if (deleteDataBuku($book_id) > 0) {
      $message = "Data Buku berhasil dihapus";
      $alertType = "primary";
      $alertIcon = "ri-check-line";
   } else {
      $message = "Data Buku gagal dihapus";
      $alertType = "danger";
      $alertIcon = "ri-close-line";
   }
}

if (!isSessionStillAlive($_SESSION)) {
   // If the session does not exist in the database, delete the existing session and redirect to the login page
   session_unset();
   session_destroy();
   header("Location: login.php");
   exit();
}

$user = getData("users");
// Mengambil data buku di database
$bukus = getData("buku");

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
                     <div class="iq-header-title">
                        <h4 class="card-title">Book Lists</h4>
                     </div>
                     <div class="iq-card-header-toolbar d-flex align-items-center">
                        <a href="admin-add-book.php" class="btn btn-primary">Add New book</a>
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
                     <div class="table-responsive">
                        <table class="data-tables table table-striped table-bordered" style="width:100%">
                           <thead>
                              <tr>
                                 <th style="width: 3%;">No</th>
                                 <th style="width: 12%;">Book Image</th>
                                 <th style="width: 15%;">Book Name</th>
                                 <th style="width: 10%;">Book Author</th>
                                 <th style="width: 10%;">Book Publisher</th>
                                 <th style="width: 18%;">Book Description</th>
                                 <th style="width: 7%;">Book Year</th>
                                 <th style="width: 7%;">Book pdf</th>
                                 <th style="width: 10%;">Category Book</th>
                                 <th style="width: 15%;">Action</th>
                              </tr>
                           </thead>
                           <?php $i = 1; ?>
                           <?php
                           $i = 1;
                           $cname[0] = "Not Set";
                           $categories = $koneksi->query("SELECT * FROM categories");
                           foreach ($categories as $row) {
                              $cname[$row['id_category']] = ucwords($row['category_name']);
                           }
                           $bukus = $koneksi->query("SELECT * FROM buku");
                           foreach ($bukus as $buku) :
                           ?>
                              <tbody>
                                 <tr>
                                    <td><?= $i++; ?></td>
                                    <td><img class="img-fluid rounded" src="resources/cover/<?= $buku["gambar_buku"] ?>" alt=""></td>
                                    <td><?= $buku["judul_buku"] ?></td>
                                    <td><?= $buku["penulis"] ?></td>
                                    <td><?= $buku["penerbit"] ?></td>
                                    <td>
                                       <p class="mb-0"><?= $buku["deskripsi_buku"] ?></p>
                                    </td>
                                    <td><?= $buku["tahun_terbit"] ?></td>
                                    <td><a href="resources/ebook/<?= $buku["pdf_buku"] ?>"><i class="ri-file-fill text-secondary font-size-18"></i></a></td>
                                    <td>
                                       <p>
                                          <?php
                                          $cats = '';
                                          $cat = explode(',', $buku['category_ids']);
                                          foreach ($cat as $key => $value) {
                                             if (!empty($cats)) {
                                                $cats .= ", ";
                                             }
                                             if (isset($cname[$value])) {
                                                $cats .= $cname[$value];
                                             }
                                          }
                                          echo $cats;
                                          ?>
                                       </p>
                                    </td>
                                    <td>
                                       <form action="" method="post">
                                          <div class="flex align-items-center list-user-action">
                                             <input type="hidden" name="id_buku" value="<?= $buku["id_buku"] ?>">
                                             <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="admin-add-book.php?id_buku=<?= $buku["id_buku"]; ?>"><i class="ri-pencil-line"></i></a>
                                             <a class="bg-primary" data-toggle="tooltip" data-placement="top" name="delete" href="?book_id=<?= $buku["id_buku"] ?>"><i class="ri-delete-bin-line"></i></a>
                                          </div>
                                       </form>
                                    </td>
                                 </tr>
                              </tbody>
                           <?php endforeach ?>
                        </table>
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

</html>