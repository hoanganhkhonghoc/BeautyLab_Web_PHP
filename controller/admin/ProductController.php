<?php 
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load web
    require_once PATH_SYSTEM.'/core/view/view.php';
    // add model
    require_once PATH_MODEL. '/categoryModel.php';
    require_once PATH_MODEL. '/productModel.php';
    /* 
        url: index.php?c=product&a=index
        $data['product'] values from product table;
        Load: product-list
    */
    function indexAction(){
        $data = [];
        $data['product'] = getAllValueFromProduct();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Product/product-list',$data);
    }
    /* 
        url: index.php?c=product&a=add
        $data = [];
        Load: product-add
    */
    function addAction(){
        $data = [];
        $data['category'] = getAllValueFromCategory();
        loadView('master','Product/product-add',$data);
    }
    /* 
        url: index.php?c=product&a=xl_add
        get value from product-add then add product table
        Navigation: index.php?c=product&a=index
    */
    function xl_addAction(){
        // check submit from login
        if(!isset($_POST['submit'])){
            die("Phải nhập dữ liệu vào trong");
        }
        $data['namePro'] = $_POST['name'];
        $data['isDeleted'] = $_POST['isDeleted'];
        $data['cat_id'] = $_POST['cate'];
        $data['staff_id'] = $_SESSION['account']['id'];
        store('product',$data);
        header("Location: index.php?c=product&a=index");
    }
    /* 
        url: index.php?c=product&a=edit&id=??
        get id from methods GET 
        Load: product-edit
    */
    function editAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data['product'] = getById('product',$_GET['id'],'id');
            $data['category'] = getAllValueFromCategory();
            // echo "<pre>";
            // print_r($data);
            // die;
            loadView('master','Product/product-edit',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=product&a=xl_edit
        get value from product-add then add product table
        Navigation: index.php?c=product&a=index
    */
    function xl_editAction(){
        if(isset($_GET['id'])){
            // check submit from login
            if(!isset($_POST['submit'])){
                die("Phải nhập dữ liệu vào trong");
            }
            $data['namePro'] = $_POST['name'];
            $data['isDeleted'] = $_POST['isDeleted'];
            $data['cat_id'] = $_POST['cate'];
            if($_SESSION['account']['level'] == 2){
                $data['staff_id'] = $_SESSION['account']['id'];
            }else{
                $data['staff_id'] = 1;
            }
            update('product','id',$_GET['id'],$data);
            header("Location: index.php?c=product&a=index");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
