<?php
// Mulai Session
session_start();
require("model.php");

// Check login
if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

// Check parameter get hapus
if (isset($_GET["hapus"])) {
   $id_user = $_GET["hapus"];
   $result = deleteUser($id_user);
   if ($result === true) {
      $message = "<strong> User Successfully Removed !</strong>";
      $alertType = "primary";
      $alertIcon = "ri-check-line";
   } else {
      $message = "<strong> User failed to remove!</strong>";
      $alertType = "danger";
      $alertIcon = "ri-close-line";
   }
}

// Mengambil data user
$user = getData("users");

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
                        <h4 class="card-title">User List</h4>
                     </div>
                  </div>
                  <?php if (isset($message)) : ?>
                     <div class="alert alert-<?= $alertType ?> mr-0 ml-0" role="alert">
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
                        <div class="row justify-content-between">
                           <div class="col-sm-12 col-md-6">
                              <div id="user_list_datatable_info" class="dataTables_filter">
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6">
                              <div class="user-list-files d-flex float-right">
                                 <a class="iq-bg-primary" href="javascript:void(window.print());">
                                    Print
                                 </a>
                              </div>
                           </div>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4 table-hover" role="grid" aria-describedby="user-list-page-info">
                           <thead>
                              <tr>
                                 <th>Profile</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Gender</th>
                                 <th>Birth date</th>
                                 <th>Join Date</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $users = oci_parse($koneksi, "SELECT * FROM users");
                              oci_execute($users);
                              while ($value = oci_fetch_assoc($users)) : ?>
                                 <tr>
                                    <td class="text-center">
                                       <?php if (empty($value['user_photo'])) : ?>
                                          <img class="rounded img-fluid avatar-40" src="resources/profile/default.jpg" alt="user">
                                       <?php else : ?>
                                          <img class="rounded img-fluid avatar-40" src="resources/profile/<?= $value['user_photo'] ?>" alt="profile">
                                    </td>
                                 <?php endif; ?>
                                 <td><?php echo $value["full_name"]; ?></td>
                                 <td><?php echo $value["email"]; ?></td>
                                 <td><span class="badge iq-bg-primary"><?php echo $value["gender"]; ?></span></td>
                                 <td><?php echo $value["birth_date"]; ?></td>
                                 <td><?php echo $value["date_created"]; ?></td>
                                 <td>
                                    <div class="flex align-items-center list-user-action">
                                       <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="user-list.php?hapus=<?php echo $value["id_user"]; ?>"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                 </td>
                                 </tr>
                              <?php
                              endwhile;
                              // End of Loop 
                              ?>
                           </tbody>

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