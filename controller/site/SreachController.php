<?php
// load web
require_once PATH_SYSTEM . '/core/view/view.php';
// add model
require_once PATH_MODEL . '/product_detailModel.php';
require_once PATH_MODEL . '/categoryModel.php';
require_once PATH_MODEL . '/sreachModel.php';
require_once PATH_MODEL . '/likeModel.php';
require_once PATH_MODEL . '/cardModel.php';

function indexAction(){
    if(!isset($_POST['submit'])){header('Location: ' . $_SERVER['HTTP_REFERER']);}
    if (isset($_SESSION['account']['id'])) {
        $id = $_SESSION['account']['id'];
    } else {
        $id = 0;
    }
    // $_SESSION['key'] = $_POST['key'];
    $cate = 0;
    $data = [];
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if(isset($_POST['beauty-service'])){
        if($_POST['beauty-service'] == 0){
            $data = sreachPro($_POST['key'], $page, $cate);
            $data['slCard'] = totalRecordCard($id);
            $data['likePro'] = getAllLikeById($id);
            $data['category'] = getAllValueFromCategory();
            loadView('master', 'Product/product-list', $data);
            // k chon danh muc
        }else{
            $cate = $_POST['beauty-service'];
            $data = sreachPro($_POST['key'], $page, $cate);
            $data['slCard'] = totalRecordCard($id);
            $data['likePro'] = getAllLikeById($id);
            $data['category'] = getAllValueFromCategory();
            loadView('master', 'Product/product-list', $data);
            // co chon danh muc
        }
    }else{
        // khong co danh muc
        $data = sreachPro($_POST['key'], $page, $cate);
        $data['slCard'] = totalRecordCard($id);
        $data['likePro'] = getAllLikeById($id);
        $data['category'] = getAllValueFromCategory();
        loadView('master', 'Product/product-list', $data);
    }
}
