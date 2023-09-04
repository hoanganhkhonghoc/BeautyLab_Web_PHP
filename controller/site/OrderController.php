<?php
// load web
require_once PATH_SYSTEM . '/core/view/view.php';
// require_once model
require_once PATH_MODEL . '/discountModel.php';
require_once PATH_MODEL . '/product_detailModel.php';
require_once PATH_MODEL . '/checkoutModel.php';
require_once PATH_MODEL . '/orderModel.php';

function indexAction()
{
    $data = [];
    $data['pay'] = getAll('payment_methods');
    $data['product'] = getAllProductInCart($_SESSION['account']['id']);
    loadView('master', 'Order/checkout', $data);
}

function addAction()
{
    if (!isset($_POST['woocommerce_checkout_place_order'])) {
        header('Location: index.php?c=order&a=list');
    } else {
        $data = [];
        $data['receiver']['name'] = $_POST['billing_company'];
        $data['receiver']['phone'] = $_POST['billing_phone'];
        $data['receiver']['address'] = $_POST['billing_address_1'];
        $data['receiver']['sex'] = $_SESSION['account']['sex'];
        $data['receiver']['client_id'] = $_SESSION['account']['id'];
        store('receiver', $data['receiver']);
        $data['order']['receiver_id'] = getReceiver($_SESSION['account']['id']);
        $data['order']['pay_id'] = $_POST['payment_method'];
        $data['order']['sum_total'] = $_SESSION['giatongdon'];
        $data['order']['status'] = 1;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = getdate();
        $data['order']['date_order'] = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];
        $data['order']['client_id'] = $_SESSION['account']['id'];
        store('order', $data['order']);
        $data['order_detail']['order_id'] = getIdOrderDECS($_SESSION['account']['id']);
        $cart = getIdCart($_SESSION['account']['id']);
        $data['cart_detail_tt'] = getAllCartDetailForCheckout($cart);
        foreach ($data['cart_detail_tt'] as $pro) {
            $data['order_detail']['product_id'] = $pro['product_detail_id'];
            $data['order_detail']['quanity'] = $pro['quanity'];
            $data['order_detail']['price'] = $pro['price'];
            store('order_detail', $data['order_detail']);
            update_quanity_product($data['order_detail']['product_id'], $data['order_detail']['quanity']);
            dropCart_detail($data['order_detail']['product_id'], $cart);
        }
        loadView('master', 'Order/thankyou', $data);
    }
    // echo "<pre>";
    // print_r($data);
    // die;
}
function listAction(){
    $data = [];
    $data['order'] = getOrderByIdClient($_SESSION['account']['id']);
    // echo "<pre>";
    // print_r($data);
    // die;
    loadView('master', 'Order/list', $data);
}
function detailAction(){
    if(!isset($_GET['id'])){
        die('ERROR');
    }
    $data = [];
    $data['product'] = getProInOrder($_GET['id'], $_SESSION['account']['id']);
    $data['order'] = getById('order',$_GET['id'],'id');
    $data['pay'] = getById('payment_methods',$data['order']['pay_id'],'id');
    $data['receiver'] = getById('receiver',$data['order']['receiver_id'],'id');
    $data['client'] = getById('client',$data['order']['client_id'],'id');
    // echo "<pre>";
    // print_r($data);
    // die;
    loadView('master', 'Order/detail', $data);
}
function deleteAction(){
    if(!isset($_GET['id'])){
        die();
    }
    $data = getById('order',$_GET['id'],'id');
    // echo "<pre>";
    // print_r($data);
    // die;
    if($data['status'] > 1 && $data['status'] > 0){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        updateOrder($_GET['id'], 0);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}