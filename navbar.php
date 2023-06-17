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
                <h5 class="mb-0"><?php echo getPageName(); ?></h5>
            </div>
            <?php
            if (basename($_SERVER['PHP_SELF']) === 'index.php') {
            ?>
                <div class="iq-search-bar">
                    <form action="" class="searchbox" id="searchForm" method="get">
                        <input type="text" name="keyword" class="text search-input" placeholder="Search Here...">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                    </form>
                </div>
            <?php
            }
            ?>
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
                            <?php if (empty($_SESSION['user_photo'])) : ?>
                                <img src="resources/profile/default.jpg" class="img-fluid rounded-circle mr-3" alt="user">
                            <?php else : ?>
                                <img src="resources/profile/<?= $_SESSION['user_photo'] ?>" class="img-fluid rounded-circle mr-3" alt="user">
                            <?php endif; ?>
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