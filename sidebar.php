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
                <li class="active"><a href="index.php"><i class="las la-home active active-menu"></i>Home</a></li>
                <li>
                    <a href="#book" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="ri-book-line"></i><span>Book Menu</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="book" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="category.html"><i class="ri-function-line"></i>Book Category</a></li>
                        <li><a href="book-page.php"><i class="ri-book-line"></i>Book Page</a></li>
                        <li><a href="readingList.php"><i class="ri-heart-line"></i>Reading List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#admin" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Admin</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="admin" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="admin-books.php"><i class="ri-file-pdf-line"></i>Books</a></li>
                        <li><a href="user-list.php"><i class="las la-th-list"></i>User List</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>