<?php
    // load web
    require_once PATH_SYSTEM.'/core/view/view.php';
    // add model
    require_once PATH_MODEL. '/cosoModel.php';
    /* 
        url: index.php?c=index&a=index
        $data['facilities'] - all facilities in facilities
        loadView: home
    */
    function indexAction(){
        $data = [];
        $data['facilities'] = getAllCo_so();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Home/home',$data);
    }
    /* 
        url: index.php?c=index&a=book
        $data[] - all Information in from ( methods: POST ) to appoinment table
        Navigation: index.php?c=index&a=index
    */
    function bookAction(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = [];
        $data['name'] = $_POST['name'];
        $data['phone'] = $_POST['phone'];
        $data['email'] = $_POST['email'];
        $date = str_replace("/", "-", $_POST['date']);
        $data['date'] = date("Y-m-d", strtotime($date));
        $data['service'] = $_POST['beauty-service'];
        $data['facilities_id'] = $_POST['beauty-expart'];
        $data['detail'] = $_POST['msg-area'];
        // echo "<pre>";
        // print_r($data);
        // die;
        store('appointment',$data);
        header("Location:index.php?c=index&a=index");
    }
    /* 
        url: index.php?c=index&a=newStaff
        $data[] - all Information in from ( methods: POST ) to newStaff table
        Navigation: index.php?c=index&a=index
    */
    function newStaffAction(){
        $data = [];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['admin_id'] = 1;
        // echo "<pre>";
        // print_r($data);
        // die; 
        store('newStaff',$data);
        header("Location:index.php?c=index&a=index");
    }
    /* 
        url: index.php?c=index&a=login
        $data = null;
        if isset SESSION from register then unset SESSION
        loadView: login
    */
    function loginAction(){
        if(isset($_SESSION['regis_name'])){
            unset($_SESSION['regis_name']);
        }
        if(isset($_SESSION['err_regis'])){
            unset($_SESSION['err_regis']);
        }
        if(isset($_SESSION['err_email'])){
            unset($_SESSION['err_email']);
        }
        if(isset($_SESSION['err_phone'])){
            unset($_SESSION['err_phone']);
        }
        if(isset($_SESSION['err_pass'])){
            unset($_SESSION['err_pass']);
        }
        if(isset($_SESSION['regis_email'])){
            unset($_SESSION['regis_email']);
        }
        if(isset($_SESSION['regis_phone'])){
            unset($_SESSION['regis_phone']);
        }
        if(isset($_SESSION['regis_add'])){
            unset($_SESSION['regis_add']);
        }
        $data = [];
        loadView('master','Login/login',$data);
    }
    /* 
        url: index.php?c=index&a=xl_login
        $data[] - all Information in from ( methods: POST ) to client table
        Navigation: index.php
    */
    function xl_loginAction(){
        // check submit from login
        if(!isset($_POST['submit'])){
            die("Phải nhập dữ liệu vào trong");
        }
        $name = $_POST['email'];
        $pass = md5($_POST['pass']);
        $rs = selectColumAccount('email',$name);
        // echo mysqli_num_rows($rs);die();
        // check email isset
        if(mysqli_num_rows($rs) == 0){
            $_SESSION['login_email'] = $name;
            $_SESSION['err_email'] = $name;
            if(isset($_SESSION['login_pass'])){
                unset($_SESSION['login_pass']);
            }
            if(isset($_SESSION['err_pass'])){
                unset($_SESSION['err_pass']);
            }
            if(isset($_SESSION['err_login'])){
                unset($_SESSION['err_login']);
            }

            $_SESSION['err_login'] = 'Không tìm thấy email !!';
            header("Location:index.php?c=index&a=login");
        }else{
            $resrut = selectAccount($name,$pass);
            // echo $resrut;
            // check account isset ( pass check )
            if(mysqli_num_rows($resrut) == 0){
                $_SESSION['login_email'] = $name;
                $_SESSION['err_pass'] = 'h';
                $_SESSION['err_login'] = 'Sai mật khẩu !!';
                header("Location:index.php?c=index&a=login");
            }else{
                $do = mysqli_fetch_assoc($resrut);
                $_SESSION['account']['email'] = $do['email'];
                $_SESSION['account']['phone'] = $do['phone'];
                $_SESSION['account']['level'] = $do['level'];
                $_SESSION['account']['name'] = $do['name'];
                $_SESSION['account']['address'] = $do['address'];
                $_SESSION['account']['sex'] = $do['sex'];
                $_SESSION['account']['id'] = $do['id'];
                $_SESSION['account']['isDelete'] = $do['isDeleted'];
                if($do['level'] == 2){
                    $_SESSION['account']['facilites'] = $do['facilites_id'];
                    $data = getById('Quyen_han',$_SESSION['account']['id'], 'staff_id');
                    if($data['binh_luan'] == 1){
                        $_SESSION['Quyen']['binh_luan'] = $data['binh_luan'];
                    }
                    if($data['lich_dat_truoc'] == 1){
                        $_SESSION['Quyen']['lich_dat_truoc'] = $data['lich_dat_truoc'];
                    }
                    if($data['tuyen_dung'] == 1){
                        $_SESSION['Quyen']['tuyen_dung'] = $data['tuyen_dung'];
                    }
                    if($data['ql_san_pham'] == 1){
                        $_SESSION['Quyen']['ql_san_pham'] = $data['ql_san_pham'];
                    }
                    if($data['ql_danhmuc'] == 1){
                        $_SESSION['Quyen']['ql_danhmuc'] = $data['ql_danhmuc'];
                    }
                    if($data['xl_donhang'] == 1){
                        $_SESSION['Quyen']['xl_donhang'] = $data['xl_donhang'];
                    }
                    if($data['ql_nhanvien'] == 1){
                        $_SESSION['Quyen']['ql_nhanvien'] = $data['ql_nhanvien'];
                    }
                    if($data['ql_khachhang'] == 1){
                        $_SESSION['Quyen']['ql_khachhang'] = $data['ql_khachhang'];
                    }
                    if($data['ql_baiviet'] == 1){
                        $_SESSION['Quyen']['ql_baiviet'] = $data['ql_baiviet'];
                    }
                    
                }
                // echo "<pre>";
                // print_r($_SESSION['account']);
                // die;
                // unset SESSION error from Login
                if(isset($_SESSION['login_pass'])){
                    unset($_SESSION['login_pass']);
                }
                if(isset($_SESSION['err_pass'])){
                    unset($_SESSION['err_pass']);
                }
                if(isset($_SESSION['err_login'])){
                    unset($_SESSION['err_login']);
                }
                if(isset($_SESSION['login_email'])){
                    unset($_SESSION['login_email']);
                }
                if(isset($_SESSION['err_email'])){
                    unset($_SESSION['err_email']);
                }
                // check account isDeleted != 0
                if($_SESSION['account']['isDelete'] == 1){
                    header("Location: index.php");
                }else{
                    $_SESSION['err_login'] = "Không tìm thấy email !!";
                    header("Location: index.php?c=index&a=login");
                }
            }
        }
    }
    /* 
        url: index.php?c=index&a=register
        $data[] = null;
        if SESSION from login isset then unset SESSION
        loadView: register
    */
    function registerAction(){
        // unset SESSION error from Login
        if(isset($_SESSION['err_login'])){
            unset($_SESSION['err_login']);
        }
        if(isset($_SESSION['login_email'])){
            unset($_SESSION['login_email']);
        }
        if(isset($_SESSION['err_pass'])){
            unset($_SESSION['err_pass']);
        }
        if(isset($_SESSION['login_pass'])){
            unset($_SESSION['login_pass']);
        }
        $data = [];
        loadView('master','Login/register',$data);
    }
    /* 
        url: index.php?c=index&a=xl_regis
        $data[] - all Information in from ( methods: POST ) to client table
        Navigation: index.php?c=index&a=login
    */
    function xl_regisAction(){
        // check submit from register
        if(!isset($_POST['submit'])){
            die("Phải nhập dữ liệu vào trong");
        }
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['phone'] = $_POST['phone'];
        $data['address'] = $_POST['address'];
        $data['sex'] = $_POST['sex'];
        $pass = $_POST['pass'];
        $pass1 = $_POST['pass1'];
        // echo "<pre>";
        // print_r($data);
        // die;
        $rs = selectColumAccount('email',$data['email']);
        // echo mysqli_num_rows($rs);die();
        // check email isset
        if(mysqli_num_rows($rs) != 0){
            $_SESSION['regis_name'] = $data['name'];
            $_SESSION['regis_sex'] = $data['sex'];
            $_SESSION['regis_email'] = $data['email'];
            $_SESSION['regis_phone'] = $data['phone'];
            $_SESSION['regis_add'] = $data['address'];
            $_SESSION['err_email'] = $data['email'];
            $_SESSION['err_regis'] = 'Email đã tồn tại !!';
            header("Location:index.php?c=index&a=register");
        }else{
            if($pass == $pass1){
                if(isset($_SESSION['err_email'])){
                    unset($_SESSION['err_email']);
                }
                $resrut = selectColumAccount('phone',$data['phone']);
                // echo mysqli_num_rows($resrut);
                if(mysqli_num_rows($resrut) != 0){
                    if(isset($_SESSION['err_pass'])){
                        unset($_SESSION['err_pass']);
                    }
                    $_SESSION['err_phone'] = $data['phone'];
                    $_SESSION['err_regis'] = 'Số điện thoại đã được đăng ký !!';
                    header("Location:index.php?c=index&a=register");
                }else{
                    if(isset($_SESSION['err_phone'])){
                        unset($_SESSION['err_phone']);
                    }
                    if(isset($_SESSION['err_regis'])){
                        unset($_SESSION['err_regis']);
                    }
                    $data['pass'] = md5($pass);
                    $data['level'] = 3;
                    $data['isDeleted'] = 1;
                    $data['admin_id'] = 1;
                    store('client',$data);
                    header("Location:index.php?c=index&a=login");
                }
            }else{
                if(isset($_SESSION['err_email'])){
                    unset($_SESSION['err_email']);
                }
                $_SESSION['err_pass'] = $pass1;
                $_SESSION['err_regis'] = 'Mật khẩu không khớp !!';
                header("Location:index.php?c=index&a=register");
            }
        }
    }
    /* 
        url: index.php?c=index&a=logout
        unset SESSION account
        Navigation: index.php
    */
    function logoutAction(){
        unset($_SESSION['account']);
        unset($_SESSION['cart']);
        header("Location: index.php");
    }
