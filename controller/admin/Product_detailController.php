<?php 
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load view
    require_once PATH_SYSTEM.'/core/view/view.php';
    // add model
    require_once PATH_MODEL. '/productModel.php';
    require_once PATH_MODEL. '/product_detailModel.php';
    /* 
        url: index.php?c=product_detail&a=index&id=???
        $data['product_detail'] All values from product_detail table by id = GET['id'];
        $data['product'] values from product table by id = $data['product_detail']['product_id'];
        Load: product_detail-list
    */
    function indexAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data['product_detail'] = getAllValueFromProduct_detail($_GET['id']);
            $data['product'] = getById('product',$_GET['id'],'id');
            // echo "<pre>";
            // print_r($data);
            // die;
            loadView('master','Product_detail/product_detail-list',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=product_detail&a=add
        $data['product'] get product by Id = Get['id]
        Load: product_detail-add
    */
    function addAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data['product'] = getById('product',$_GET['id'],'id');
            loadView('master','Product_detail/product_detail-add',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=product_detail&a=xl_add
        get value from product_detail-add then add product_detail table
        Navigation: index.php?c=product_detail&a=index&id=GET['id']
    */
    function xl_addAction(){
        if(isset($_GET['id'])){
            // check submit from login
            if(!isset($_POST['submit'])){
                die("Phải nhập dữ liệu vào trong");
            }
            $id = $_GET['id'];
            $data['quanity'] = $_POST['quanity'];
            $data['price'] = $_POST['price'];
            $data['color'] = $_POST['color'];
            $data['detail'] = $_POST['detail'];
            $data['isSoid'] = $_POST['isSoid'];
            $data['product_id'] = $_GET['id'];
            if(!empty($_FILES['imgPro']['name'])) {
                $data['img'] = $_FILES['imgPro']['name'];
                $tmp_name = $_FILES['imgPro']['tmp_name'];
                move_uploaded_file($tmp_name, 'public/uploads/'.$data['img']);
            }else{
                $data['img'] = "no-img.png";
            }
            // echo "<pre>";
            // print_r($data);
            // die;
            store('product_detail',$data);
            header("Location: index.php?c=product_detail&a=index&id=$id");
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=product_detail&a=show&id=???
        $data['product_detail'] values from product_detail table by id = GET['id'];
        $data['product'] values from product table by id = $data['product_detail']['product_id'];
        Load: product_detail-show
    */
    function showAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data['product_detail'] = getById('product_detail',$_GET['id'],'id');
            $data['product'] = getById('product',$data['product_detail']['product_id'],'id');
            $data['category'] = getById('category',$data['product']['cat_id'],'id');
            // echo "<pre>";
            // print_r($data);
            // die;
            loadView('master','Product_detail/product_detail-show',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=product_detail&a=edit&id=??
        get id from methods GET 
        Load: product_detail-edit
    */
    function editAction(){
        if(isset($_GET['id'])){
            $data = [];
            $data['product_detail'] = getById('product_detail',$_GET['id'],'id');
            $data['product'] = getById('product',$data['product_detail']['product_id'],'id');
            // echo "<pre>";
            // print_r($data);
            // die;
            loadView('master','Product_detail/product_detail-edit',$data);
        }else{
            header("location:view/admin/error/404.php");
        }
    }
    /* 
        url: index.php?c=product_detail&a=xl_edit&id=??
        get id from methods GET 
        Load: product_detail-list
    */
    function xl_editAction(){
        if(isset($_GET['id'])){
            // check submit from login
            if(!isset($_POST['submit'])){
                die("Phải nhập dữ liệu vào trong");
            }
            $id = $_GET['id'];
            $idlis = $_GET['idLis'];
            if(!empty($_FILES['imgPro']['name'])) {
                $data['img'] = $_FILES['imgPro']['name'];
                $tmp_name = $_FILES['imgPro']['tmp_name'];
                move_uploaded_file($tmp_name, 'public/uploads/'.$data['img']);
            }
            $data['color'] = $_POST['color'];
            $data['quanity'] = $_POST['quanity'];
            $data['price'] = $_POST['price'];
            if($_POST['detail'] != null){
                $data['detail'] = $_POST['detail'];
            }
            $data['isSoid'] = $_POST['isSoid'];
            // echo "<pre>";
            // print_r($data);
            // die;
            update('product_detail','id',$id,$data);
            header("Location: index.php?c=product_detail&a=index&id=$idlis");
        }else{
            header("location:");
        }
    }
    /* 
        url: index.php?c=product_detail&a=delete&id=??
        get id from methods GET 
        Load: product_detail-list
    */
    function deleteAction(){
        if(isset($_GET['id'])){
            $idlist = $_GET['idLis'];
            $id = $_GET['id'];
            deleteRecordById('product_detail','id',$id);
            header("Location: index.php?c=product_detail&a=index&id=$idlist");
        }else{
            header("location:");
        }
    }
