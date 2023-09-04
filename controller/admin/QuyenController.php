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
    require_once PATH_MODEL. '/staffModel.php';
    require_once PATH_MODEL. '/quyenhanModel.php';

    // Hàm index -> load list danh sách tài khoản
    function indexAction(){
        $data = [];
        $data['staff'] = getAllValueFromStaff();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Quyen_han/quyen-list',$data);
    }
    // Hàm xem quyền hạn của tài khoản
    function showAction(){
        if(!isset($_GET['id'])){
            die();
        }
        $data['quyen'] = getById('Quyen_han',$_GET['id'],'staff_id');
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Quyen_han/show',$data);
    }
    // Hàm kiểm cập nhật quyền
    function updateAction(){
        if(!isset($_GET['id'])){
            die();
        }

        if($_POST['binh_luan'] == null){
            $_POST['binh_luan'] = 0;
        }else{
            $_POST['binh_luan'] = 1;
        }

        if($_POST['lich_dat_truoc'] == null){
            $_POST['lich_dat_truoc'] = 0;
        }else{
            $_POST['lich_dat_truoc'] = 1;
        }
        
        if($_POST['tuyen_dung'] == null){
            $_POST['tuyen_dung'] = 0;
        }else{
            $_POST['tuyen_dung'] = 1;
        }

        if($_POST['ql_san_pham'] == null){
            $_POST['ql_san_pham'] = 0;
        }else{
            $_POST['ql_san_pham'] = 1;
        }

        if($_POST['xl_donhang'] == null){
            $_POST['xl_donhang'] = 0;
        }else{
            $_POST['xl_donhang'] = 1;
        }

        if($_POST['ql_khachhang'] == null){
            $_POST['ql_khachhang'] = 0;
        }else{
            $_POST['ql_khachhang'] = 1;
        }

        if($_POST['ql_baiviet'] == null){
            $_POST['ql_baiviet'] = 0;
        }else{
            $_POST['ql_baiviet'] = 1;
        }

        $data['Quyen_han']['binh_luan'] = $_POST['binh_luan'];
        $data['Quyen_han']['lich_dat_truoc'] = $_POST['lich_dat_truoc'];
        $data['Quyen_han']['tuyen_dung'] = $_POST['tuyen_dung'];
        $data['Quyen_han']['ql_san_pham'] = $_POST['ql_san_pham'];
        $data['Quyen_han']['xl_donhang'] = $_POST['xl_donhang'];
        $data['Quyen_han']['ql_khachhang'] = $_POST['ql_khachhang'];
        $data['Quyen_han']['ql_baiviet'] = $_POST['ql_baiviet'];
        $data['Quyen_han']['staff_id'] = $_GET['id'];

        $check = checkQuyenStaff($_GET['id']);

        if($check == 0){
            store('Quyen_han', $data['Quyen_han']);
        }else{
            update('Quyen_han','staff_id',$_GET['id'],$data['Quyen_han']);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }