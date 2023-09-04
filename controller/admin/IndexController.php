<?php 
    // check account if admin and staff
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load web
    require_once PATH_SYSTEM.'/core/view/view.php';
    // require_model
    require_once PATH_MODEL. '/accountModel.php';
    require_once PATH_MODEL. '/dashboardModel.php';
    require_once PATH_SYSTEM. "/core/helper/helper.php";
    /* 
        url: index.php?c=index&a=index
        $data = [];
        Load: dashbroad
    */
    function indexAction(){
        $data = [];
        $data['product'] = get5ProductInOrder();
        $data['don_hang'] = getDonHang();
        $data['tongdon'] = getTongDon();
        $data['doanhthu'] = doanhthu();
        $data['donhang_canxuly'] = donHangCanXuLy(1);
        $data['donhang_huy'] = donHangCanXuLy(0);
        $data['sanpham_saphet'] = getSanPhamSapHet();
        $data['sanpham_dahet'] = getSanPhamdaHet();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Dashbroad/dashbroad',$data);
    }
    /* 
        url: index.php?c=index&a=logout
        unset SESSION account
        Navigation: index.php
    */
    function logoutAction(){
        unset($_SESSION['account']);
        unset($_SESSION['Quyen']);
        header("Location: index.php");
    }
    /* 
        url: index.php?c=index&a=account
        $data['account] = check level $_SESSION and get value table
        Load: account-show
    */
    function accountAction(){
        $data = [];
        $data['account'] = getAccountByLevelAndID($_SESSION['account']['level'],$_SESSION['account']['id']);
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Account/account-show',$data);
    }
    /*  
        url: index.php?c=index&a=xl_edit
        Get value to from check account level edit table admin or staff
        Navigation: index.php?c=index&a=account
    */
    function xl_editAction(){
        // check submit from login
        if(!isset($_POST['submit'])){
            die("Phải nhập dữ liệu vào trong");
        }
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($_POST['email'] != $_GET['email']){
                $rs = selectColumAccount('email',$_POST['email']);
                if(mysqli_num_rows($rs) != 0){
                    if(isset($_SESSION['err_phone'])){
                        unset($_SESSION['err_phone']);
                    }
                    $_SESSION['err_email'] = $_POST['email'];
                    header("Location:index.php?c=index&a=account");
                }else{
                    $data['email'] = $_POST['email'];
                }
            }else if($_POST['phone'] != $_GET['phone']){
                $res = selectColumAccount('phone',$_POST['phone']);
                if(mysqli_num_rows($res) != 0){
                    if(isset($_SESSION['err_email'])){
                        unset($_SESSION['err_email']);
                    }
                    $_SESSION['err_phone'] = $_POST['phone'];
                    header("Location:index.php?c=index&a=account");
                }else{
                    $data['phone'] = $_POST['phone'];
                }
            }else{
                if(isset($_SESSION['err_email'])){
                    unset($_SESSION['err_email']);
                }
                if(isset($_SESSION['err_phone'])){
                    unset($_SESSION['err_phone']);
                }
            }
            $data['sex'] = $_POST['sex'];
            $data['name'] = $_POST['name'];
            $data['address'] = $_POST['address'];
            if($_POST['pass'] != null){
                $data['pass'] = md5($_POST['pass']);
            }
            // echo "<pre>";
            // print_r($data);
            // die;
            if($_SESSION['account']['level'] == 1){
                update('admin','id',$_GET['id'],$data);
            }else{
                update('staff','id',$_GET['id'],$data);
            }
            header("Location:index.php?c=index&a=account");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
