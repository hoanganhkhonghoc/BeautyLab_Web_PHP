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
    // require_model
    require_once PATH_MODEL. '/orderModel.php';

    // Hàm index -- Lấy toàn bộ đơn hàng
    function indexAction(){
        $data = getAllOrder(2);
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Order/order-list',$data);
    }
    // Hàm hum -- Lấy toàn bộ đơn hàng với trạng thái chờ xử lý
    function humAction(){
        $data = getAllOrder(1);
        loadView('master','Order/order-list',$data);
    }
    // Hàm humdele -- Lấy toàn bộ đơn hàng với trạng thái đã huỷ
    function humdeleAction(){
        $data = getAllOrder(0);
        loadView('master','Order/order-list',$data);
    }
    // Hàm xoá huỷ đơn hàng
    function deleteAction(){
        if(!isset($_GET['id'])){die();}
        updateOrder($_GET['id'], 0);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    // Hàm lọc những đơn hàng đang giao
    function humgiaoAction(){
        $data = getAllOrder(3);
        loadView('master','Order/order-list',$data);
    }
    // Hàm hiển thị thông tin của 1 đơn hàng
    function showAction(){
        if(!isset($_GET['id'])){
            die("ERR");
        }
        $data['order'] = getById('order',$_GET['id'],'id');
        $data['receiver'] = getById('receiver', $data['order']['receiver_id'],'id');
        $data['client'] = getById('client', $data['order']['client_id'], 'id');
        $data['product'] = getProInOrder($data['order']['id'], $data['client']['id']);
        $data['pay'] = getById('payment_methods', $data['order']['pay_id'], 'id');
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Order/order-detail',$data);
    }
    // Hàm cập nhật đơn hàng
    function xl_donhangAction(){
        if(!isset($_POST['submit'])){
            die();
        }
        // echo $_POST['status'];
        updateOrder($_GET['id'], $_POST['status']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }