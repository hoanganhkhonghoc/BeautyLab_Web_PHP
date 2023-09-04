<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamspos.dreamguystech.com/html/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 May 2023 10:23:08 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">

    <title>Beauty lab Admin</title>

    <link rel="shortcut icon" type="image/x-icon" href="public/site/images/fabicon.png">

    <link rel="stylesheet" href="public/admin/css/bootstrap.min.css">

    <link rel="stylesheet" href="public/admin/css/animate.css">

    <link rel="stylesheet" href="public/admin/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="public/admin/css/fontawesome.min.css">

    <link rel="stylesheet" href="public/admin/css/all.min.css">

    <link rel="stylesheet" href="public/admin/css/style.css">

    <link rel="stylesheet" href="public/admin/css/select2.min.css">


    <!-- preloading animation -->
    <link rel="stylesheet" href="public/site/style.css">
</head>

<body>

    <!-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> -->

    <!-- ======================================= 
            ==Start loading== 
    =======================================-->
    <div id="preloader">
        <div class="loader">
            Chờ xíu nha !!
            <span class="dot-one">.</span>
            <span class="dot-two">.</span>
            <span class="dot-three">.</span>
        </div>
    </div>
    <!-- ======================================= 
            ==End preloading== 
    =======================================-->

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="index.php" class="logo logo-normal">
                    <img src="public/site/HTML/images/widget-logo.png" alt>
                </a>
                <a href="index.php" class="logo logo-white">
                    <img src="public/site/HTML/images/widget-logo.png" alt>
                </a>
                <a href="index.php" class="logo-small">
                    <img src="public/site/images/fabicon.png" alt>
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                    <i data-feather="chevrons-left" class="feather-16"></i>
                </a>
            </div>

            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-info">
                            <span class="user-detail">
                                <span class="user-name"><?php echo $_SESSION['account']['name']; ?></span>
                                <span class="user-role"><?php if ($_SESSION['account']['level'] == 1) {
                                                            echo 'Quản lý cửa hàng';
                                                        } else {
                                                            echo 'Nhân viên';
                                                        } ?></span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img">
                                    <ion-icon style="font-size: 30px;" name="person-circle-outline"></ion-icon>
                                    <span class="status online"></span>
                                </span>
                                <div class="profilesets">
                                    <h6><?php echo $_SESSION['account']['name']; ?></h6>
                                    <h5><?php if ($_SESSION['account']['level'] == 1) {
                                            echo 'Quản lý';
                                        } else {
                                            echo 'Nhân viên';
                                        } ?></h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="index.php?c=index&a=account"> <i class="me-2" data-feather="user"></i>Thông tin tài khoản</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="index.php?c=index&a=logout"><ion-icon name="exit-outline" class="me-2"></ion-icon>Đăng xuất</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="submenu-open">
                            <h6 class="submenu-hdr">Trang chủ</h6>
                            <ul>
                                <li class="active">
                                    <a href="index.php?c=index&a=index"><i data-feather="grid"></i><span>Dashboard</span></a>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"><i data-feather="smartphone"></i><span>Quản lý</span><span class="menu-arrow"></span></a>
                                    <ul>
                                        <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['binh_luan'])){ ?>
                                            <li><a href="index.php?c=comment&a=index">Bình luận</a></li>
                                        <?php } ?>
                                        
                                        <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['lich_dat_truoc'])){ ?>
                                            <li><a href="index.php?c=appointment&a=index&month=<?php $date = getdate();
                                                                                            echo $date['mon']; ?>">Lịch đặt trước</a></li>
                                        <?php } ?>

                                        <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['tuyen_dung'])){ ?>
                                            <li><a href="index.php?c=staff&a=newStaff">Tuyển dụng</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['ql_san_pham'])){ ?>
                            <li class="submenu-open">
                                <h6 class="submenu-hdr">Quản lý sản phẩm</h6>
                                <ul>
                                    <li><a href="index.php?c=product&a="><i data-feather="box"></i><span>Sản phẩm</span></a></li>
                                    <li><a href="index.php?c=product&a=add"><i data-feather="plus-square"></i><span>Thêm sản phẩm</span></a></li>
                                    <li><a href="index.php?c=category&a="><i data-feather="codepen"></i><span>Danh mục</span></a></li>
                                    <li><a href="index.php?c=category&a=add"><i data-feather="speaker"></i><span>Thêm danh mục</span></a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['xl_donhang'])){ ?>
                            <li class="submenu-open">
                                <h6 class="submenu-hdr">Quản lý đơn hàng</h6>
                                <ul>
                                    <li class="submenu">
                                        <a href="#"><i data-feather="file-text"></i><span>Đơn hàng</span><span class="menu-arrow"></span></a>
                                        <ul>
                                            <li><a href="index.php?c=order&a=index">Tất cả đơn hàng</a></li>
                                            <li><a href="index.php?c=order&a=hum">Đơn hàng chờ xử lý</a></li>
                                            <li><a href="index.php?c=order&a=humgiao">Đơn hàng đang giao</a></li>
                                            <li><a href="index.php?c=order&a=humdele">Đơn hàng đã huỷ</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <li class="submenu-open">
                            <h6 class="submenu-hdr">Quản lý chung</h6>
                            <ul>
                                <?php if ($_SESSION['account']['level'] == 1) { ?>
                                    <li><a href="index.php?c=facilities&a=index"><i data-feather="user"></i><span>Cơ sở</span></a></li>
                                    <li><a href="index.php?c=staff&a=index"><i data-feather="users"></i><span>Nhân viên</span></a></li>
                                    <li><a href="index.php?c=quyen&a=index"><i data-feather="users"></i><span>Quyền hạn của nhân viên</span></a></li>
                                <?php } ?>
                                <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['ql_khachhang'])){ ?>
                                    <li><a href="index.php?c=client&a=index"><i data-feather="users"></i><span>Khách hàng</span></a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['ql_baiviet'])){ ?>
                            <li class="submenu-open">
                                <h6 class="submenu-hdr">Quản lý bài viết</h6>
                                <ul>
                                    <li>
                                        <a href="#"><i data-feather="file"></i><span>Bài viết</span> </a>
                                    </li>
                                    <li>
                                        <a href="#"><i data-feather="pen-tool"></i><span>Viết bài</span> </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="submenu-open">
                            <h6 class="submenu-hdr">Cài đặt</h6>
                            <ul>
                                <li>
                                    <a href="index.php?c=index&a=logout"><i data-feather="log-out"></i><span>Đăng xuất</span> </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include_once $view . '.php'; ?>

    <script src="public/admin/js/jquery-3.6.0.min.js"></script>

    <script src="public/admin/js/feather.min.js"></script>

    <script src="public/admin/js/jquery.slimscroll.min.js"></script>

    <script src="public/admin/js/jquery.dataTables.min.js"></script>
    <script src="public/admin/js/dataTables.bootstrap4.min.js"></script>

    <script src="public/admin/js/bootstrap.bundle.min.js"></script>

    <script src="public/admin/js/apexcharts.min.js"></script>
    <script src="public/admin/js/chart-data.js"></script>

    <script src="public/admin/js/script.js"></script>

    <script src="public/admin/js/jquery-ui.min.js"></script>
    <!-- preloading animation -->
    <script src="public/site/js/main.js"></script>
</body>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"> </script>
<script nomodule src="https://unpkg.com/browse/ionicons@4.2.4/dist/ionicons.js"> </script>

</html>