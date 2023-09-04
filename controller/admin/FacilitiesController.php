<?php 
    // check account if admin and staff
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load view
    require_once PATH_SYSTEM.'/core/view/view.php';
    // require Model
    require_once PATH_MODEL. '/facilitiesModel.php';
    require_once PATH_MODEL. '/productModel.php';
    /* 
        url: index.php?c=facilities&a=index
        $data['facilities'] get values All from facilities table
        Load: facilities-list
    */
    function indexAction(){
        $data = [];
        $data['facilities'] = getAllValueFromFacilities();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Facilities/facilities-list',$data);
    }
    /*
        url: index.php?c=facilities&a=add
        Load: facilities-add
    */
    function addAction(){
        $data = [];
        loadView('master','Facilities/facilities-add',$data);
    }
    /*
        url: index.php?c=facilities&a=xl_add
        Navigation: index.php?c=facilities&a=index
    */
    function xl_addAction(){
        // check submit from login
        if(!isset($_POST['submit'])){
            die("Phải nhập dữ liệu vào trong");
        }
        $data['name'] = $_POST['name'];
        $data['address'] = $_POST['address'];
        $data['admin_id'] = 1;
        store('facilities',$data);
        header("Location: index.php?c=facilities&a=index");
    }
    /*
        url: index.php?c=facilities&a=edit&id=??
        Load: facilities-edit
    */
    function editAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data['fac'] = getById('facilities',$_GET['id'],'id');
            // echo "<pre>";
            // print_r($data);
            // die;
            loadView('master','Facilities/facilities-edit',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /*
        url: index.php?c=facilities&a=xl_edit
        Navigation: index.php?c=facilities&a=index
    */
    function xl_editAction(){
        if(isset($_GET['id'])){
            // check submit from login
            if(!isset($_POST['submit'])){
                die("Phải nhập dữ liệu vào trong");
            }
            $data['name'] = $_POST['name'];
            $data['address'] = $_POST['address'];
            update('facilities','id',$_GET['id'],$data);
            header("Location: index.php?c=facilities&a=index");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /*
        url: index.php?c=facilities&a=delete&id=??
        Navigation: index.php?c=facilities&a=index
    */
    function deleteAction(){
        if(isset($_GET['id'])){
            deleteRecordById('facilities','id',$_GET['id']);
            header("Location: index.php?c=facilities&a=index");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /*
        url: index.php?c=facilities&a=show&id=??
        $data['product'] get All product in product table in one Facilities
        Load: product-list
    */
    function showAction(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data['product'] = getAllProductInFacilites($id);
            loadView('master','Product/product-list',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
