<?php
// load web
require_once PATH_SYSTEM . '/core/view/view.php';
// add model
require_once PATH_MODEL . '/product_detailModel.php';
require_once PATH_MODEL . '/categoryModel.php';
require_once PATH_MODEL . '/likeModel.php';
require_once PATH_MODEL . '/cardModel.php';
require_once PATH_MODEL . '/commentModel.php';

function showAllAction()
{
    $data = [];
    if (isset($_SESSION['account']['id'])) {
        $id = $_SESSION['account']['id'];
    } else {
        $id = 0;
    }
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $data = getAllProduct_detail($page);
    $data['likePro'] = getAllLikeById($id);
    $data['category'] = getAllValueFromCategory();
    $data['slCard'] = totalRecordCard($id);
    // echo "<pre>";
    // print_r($data);
    // die;
    loadView('master', 'Product/product-list', $data);
}
function add_likeAction()
{
    if (!isset($_GET['id'])) {
        die();
    }
    if (!isset($_SESSION['account']['id'])) {
        header("Location:index.php?c=index&a=login");
    }
    if ($_SESSION['account']['level'] < 3) {
        die();
    }
    // echo $_SESSION['account']['id'];
    likePro($_SESSION['account']['id'], $_GET['id']);
    header("Location:index.php?c=product&a=showAll");
}
function like_listAction()
{
    if (!isset($_GET['id'])) {
        die();
    }
    if (!isset($_SESSION['account']['id'])) {
        die();
    }
    if (isset($_SESSION['account']['id'])) {
        $id = $_SESSION['account']['id'];
    } else {
        $id = 0;
    }
    $data = [];
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $data = getAllLike($page, $_GET['id']);
    $data['likePro'] = getAllLikeById($id);
    $data['category'] = getAllValueFromCategory();
    $data['slCard'] = totalRecordCard($id);
    // echo "<pre>";
    // print_r($data);
    // die;
    loadView('master', 'Product/like-list', $data);
}
function detailAction()
{
    if (!isset($_GET['id'])) {
        die();
    }
    if (isset($_SESSION['account']['id'])) {
        $id = $_SESSION['account']['id'];
    } else {
        $id = 0;
    }
    $data = [];
    $data['product'] = getDetailProById($_GET['id']);
    $data['product3'] = get3DetailProDecs();
    $data['category'] = getAllValueFromCategory();
    $data['like'] = sreachLike($_GET['id'], $id);
    $data['likePro'] = getAllLikeById($id);
    $data['comment'] = getAllCommentById($_GET['id']);
    $data['totalComment'] = getTotalRecordById($_GET['id']);
    // echo "<pre>";
    // print_r($data);
    // die;
    loadView('master', 'Product/product-detail', $data);
}
function add_likeIndetailAction()
{
    if (!isset($_GET['id'])) {
        die();
    }
    if (!isset($_SESSION['account']['id'])) {
        header("Location:index.php?c=index&a=login");
    }
    if ($_SESSION['account']['level'] < 3) {
        die();
    }
    $id = $_GET['id'];
    // echo $_SESSION['account']['id'];
    likePro($_SESSION['account']['id'], $_GET['id']);
    header("Location:index.php?c=product&a=detail&id=$id");
}
function list_cateAction()
{
    if (!isset($_GET['id'])) {
        die();
    }
    $data = [];
    if (isset($_SESSION['account']['id'])) {
        $id = $_SESSION['account']['id'];
    } else {
        $id = 0;
    }
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $data = getAllProductWithCate($page, $_GET['id']);
    $data['likePro'] = getAllLikeById($id);
    $data['category'] = getAllValueFromCategory();
    // echo "<pre>";
    // print_r($data);
    // die;
    loadView('master', 'Product/product-list', $data);
}
