<?php
// load web
require_once PATH_SYSTEM . '/core/view/view.php';
// add model
require_once PATH_MODEL . '/commentModel.php';
function indexAction(){
    if(!isset($_POST['submit']) || !isset($_GET['id'])){die();}
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = getdate();
    $data['date'] = $date['year'] . '-'. $date['mon']. '-'. $date['mday']. ' '. $date['hours']. ':'.$date['minutes']. ':'. $date['seconds'];
    $data['content'] = $_POST['msg'];
    $data['client_id '] = $_SESSION['account']['id'];
    $data['product_detail_id '] = $_GET['id'];
    // echo "<pre>";
    // print_r($data);
    // die;
    store('comment',$data);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
