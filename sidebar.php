<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.php" class="header-logo">
            <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
            <div class="logo-title">
                <span class="text-primary text-uppercase">BookLib</span>
            </div>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="las la-bars"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li>
                    <a href="index.php" class="iq-waves-effect"><span class="ripple rippleEffect"></span><i class="ri-home-line"></i><span>Home</span></a>
                </li>
                <li>
                    <a href="#book" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="ri-book-line"></i><span>Book Menu</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="book" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                      <li><a href="category.php"><i class="ri-function-line"></i>Category Page</a></li>
                        <li><a href="readingList.php"><i class="ri-heart-line"></i>Reading List</a></li>
                        <li><a href="recommendation.php"><i class="ri-pantone-line"></i>Recommendation Book</a></li>
                    </ul>
                </li>
                <?php
                // Checking User Role
                $role = $_SESSION['role'];
                if ($role == 'admin') {
                ?>
                    <li>
                        <a href="#admin" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="ri-shield-user-line iq-arrow-left"></i><span>Admin</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="admin" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li><a href="admin-dashboard.php"><i class="ri-dashboard-line"></i>Admin Dashboard</a></li>
                            <li><a href="admin-books.php"><i class="ri-file-pdf-line"></i>Book Management</a></li>
                          <li><a href="admin-category.php"><i class="ri-function-line"></i>Books Category Management</a></li>
                            <li><a href="user-list.php"><i class="las la-th-list"></i>User Management</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </div>
