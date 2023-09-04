<?php 
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load web
    require_once PATH_SYSTEM.'/core/view/view.php';
    // add model
    require_once PATH_MODEL. '/categoryModel.php';
    /* 
        url: index.php?c=category&a=index
        $data['category] values from category table;
        Load: category-list
    */
    function indexAction(){
        $data = [];
        $data['category'] = getAllValueFromCategory();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Category/category-list',$data);
    }
    /* 
        url: index.php?c=category&a=add
        $data = [];
        Load: category-add
    */
    function addAction(){
        $data = [];
        loadView('master','Category/category-add',$data);
    }
    /* 
        url: index.php?c=category&a=xl_add
        get value from category-add then add category table
        Navigation: index.php?c=category&a=index
    */
    function xl_addAction(){
        // check submit from login
        if(!isset($_POST['submit'])){
            die("Phải nhập dữ liệu vào trong");
        }
        $data['nameCate'] = $_POST['name'];
        $data['isDeleted'] = 1;
        $data['staff_id'] = $_SESSION['account']['id'];
        store('category',$data);
        header("Location:index.php?c=category&a=index");
    }
    /* 
        url: index.php?c=category&a=edit&id=??
        get id from methods GET 
        Load: category-edit
    */
    function editAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data = getCategoryById($_GET['id']);
            // echo "<pre>";
            // print_r($data);
            // die;
            loadView('master','Category/category-edit',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=category&a=xl_edit&id=??
        get id from methods GET 
        Navigation: index.php?c=category&a=index
    */
    function xl_editAction(){
        if(isset($_GET['id'])){
            // check submit from login
            if(!isset($_POST['submit'])){
                die("Phải nhập dữ liệu vào trong");
            }
            $data['nameCate'] = $_POST['name'];
            update('category','id',$_GET['id'],$data);
            header("Location:index.php?c=category&a=index");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=category&a=delete&id=??
        get id from methods GET 
        Navigation: index.php?c=category&a=index
    */
    function deleteAction(){
        if(isset($_GET['id'])){
            deleteRecordById('category','id',$_GET['id']);
            header("Location:index.php?c=category&a=index");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
