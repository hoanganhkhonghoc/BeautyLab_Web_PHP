<?php 
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load web
    require_once PATH_SYSTEM.'/core/view/view.php';
    require_once PATH_MODEL. '/clientModel.php';
    /* 
        url: index.php?c=client&a=index
        $data['client'] get All client from client table
        unset $_SESSION if acc die validate from add
        Load: client-list
    */
    function indexAction(){
        if(isset($_SESSION['err_pass'])){
            unset($_SESSION['err_pass']);
        }
        if(isset($_SESSION['err_email'])){
            unset($_SESSION['err_email']);
        }
        if(isset($_SESSION['err_phone'])){
            unset($_SESSION['err_phone']);
        }

        if(isset($_SESSION['xl_email'])){
            unset($_SESSION['xl_email']);
        }
        if(isset($_SESSION['xl_name'])){
            unset($_SESSION['xl_name']);
        }
        if(isset($_SESSION['xl_phone'])){
            unset($_SESSION['xl_phone']);
        }
        if(isset($_SESSION['xl_address'])){
            unset($_SESSION['xl_address']);
        }
        if(isset($_SESSION['xl_sex'])){
            unset($_SESSION['xl_sex']);
        }
        $data = [];
        $data['client'] = getAllValueFromClient();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Client/client-list',$data);
    }
    /* 
        url: index.php?c=client&a=add
        $data = [];
        Load: client-add
    */
    function addAction(){
        $data = [];
        loadView('master','Client/client-add',$data);
    }
    /*  
        url: index.php?c=client&a=xl_add
        Get value from client-add and check then add to client table
        Navigation: index.php?c=client&a=index
    */
    function xl_addAction(){
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
        $_SESSION['xl_email'] = $data['email'];
        $_SESSION['xl_name'] = $data['name'];
        $_SESSION['xl_phone'] = $data['phone'];
        $_SESSION['xl_address'] = $data['address'];
        $_SESSION['xl_sex'] = $data['sex'];
        // echo "<pre>";
        // print_r($data);
        // die;
        $rs = selectColumAccount('email',$data['email']);
        if(mysqli_num_rows($rs) != 0){
            if(isset($_SESSION['err_pass'])){
                unset($_SESSION['err_pass']);
            }
            if(isset($_SESSION['err_phone'])){
                unset($_SESSION['err_phone']);
            }
            $_SESSION['err_email'] = $data['email'];
            header("Location:index.php?c=client&a=add");
        }else{
            $resut = selectColumAccount('phone',$data['phone']);
            if(mysqli_num_rows($resut) != 0){
                if(isset($_SESSION['err_pass'])){
                    unset($_SESSION['err_pass']);
                }
                if(isset($_SESSION['err_email'])){
                    unset($_SESSION['err_email']);
                }
                $_SESSION['err_phone'] = $data['phone'];
                header("Location:index.php?c=client&a=add");
            }else{
                if($pass == $pass1){
                    if(isset($_SESSION['err_pass'])){
                        unset($_SESSION['err_pass']);
                    }
                    if(isset($_SESSION['err_email'])){
                        unset($_SESSION['err_email']);
                    }
                    if(isset($_SESSION['err_phone'])){
                        unset($_SESSION['err_phone']);
                    }
                    unset($_SESSION['xl_email']);
                    unset($_SESSION['xl_name']);
                    unset($_SESSION['xl_phone']);
                    unset($_SESSION['xl_address']);
                    unset($_SESSION['xl_sex']);
                    $data['admin_id'] = 1;
                    $data['level'] = 3;
                    $data['pass'] = md5($pass);
                    store('client',$data);
                    header("Location:index.php?c=client&a=index");
                }else{
                    if(isset($_SESSION['err_pass'])){
                        unset($_SESSION['err_pass']);
                    }
                    if(isset($_SESSION['err_email'])){
                        unset($_SESSION['err_email']);
                    }
                    $_SESSION['err_pass'] = 'Sai pass';
                    header("Location:index.php?c=client&a=add");
                }
            }
        }
    }
    /* 
        url: index.php?c=client&a=show&id=??
        $data['client'] by id
        Load: client-show
    */
    function showAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data['client'] = getById('client',$_GET['id'],'id');
            // echo "<pre>";
            // print_r($data);
            // die;
            loadView('master','Client/client-show',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /*  
        url: index.php?c=client&a=xl_add
        Get value from client-add and check then add to client table
        Navigation: index.php?c=client&a=index
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
                    header("Location:index.php?c=client&a=show&id=$id");
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
                    header("Location:index.php?c=client&a=show&id=$id");
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
            update('client','id',$_GET['id'],$data);
            header("Location:index.php?c=client&a=show&id=$id");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /*
        url: index.php?c=client&a=delete&id=??
        Navigation: index.php?c=client&a=index
    */
    function deleteAction(){
        if(isset($_GET['id'])){
            deleteRecordById('client','id',$_GET['id']);
            header("Location: index.php?c=client&a=index");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
