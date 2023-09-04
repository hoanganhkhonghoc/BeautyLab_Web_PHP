<?php
    // load web
    require_once PATH_SYSTEM . '/core/view/view.php';
    // require_once model
    require_once PATH_MODEL . '/cardModel.php';
    require_once PATH_MODEL . '/product_detailModel.php';

    function listAction(){
        if(!isset($_SESSION['account']['id'])){die();}
        $data = [];
        $data['product1'] = getAllProductInCart($_SESSION['account']['id']);
        foreach($data['product1'] AS $pro){
            checkquanity($pro['id'], $pro['quanity']);
        }
        // echo "<pre>";
        // print_r($data);
        // die;
        $data['product'] = getAllProductInCart($_SESSION['account']['id']);
        loadView('master','Cart/cart-list', $data);
    }
    function addAction(){
        if (!isset($_GET['id'])) {
            die();
        }
        if(!isset($_SESSION['account']['id'])){
            header("Location:index.php?c=index&a=login");
        }else{
            $card = [];
            if(!isset($_POST['qty'])){
                $qty = 1;
            }else{
                $qty = $_POST['qty'];
            }
            $pro = getById('product_detail',$_GET['id'],'id');
            if($qty < 0){
                $qty = 1;
            }
            if($qty > $pro['quanity']){
                $qty = $pro['quanity'];
            }
            $data['price'] = $pro['price'];
            $check = checkCard($_SESSION['account']['id']);
            if($check > 1){
                // lỗi người dùng có 2 giỏ hàng (lỗi của người lập trình)
            }else{
                if($check < 1){
                    $card['client_id'] = $_SESSION['account']['id'];
                    store('cart',$card);
                }
                $cart = getById('cart',$_SESSION['account']['id'], 'client_id');
                // echo "<pre>";
                // print_r($cart);
                // die;
                $data['cart_id'] = $cart['id'];
                $data['product_detail_id'] = $_GET['id'];
                $checksp = checkproincard($_GET['id'], $cart['id']);
                if($checksp == 1){
                    $product = getProbyIDinCard($_GET['id'], $cart['id']);
                    $data['quanity'] = $product[0]['quanity'] + $qty;
                    updateCrad($data['quanity'], $cart['id'], $_GET['id']);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                    $data['quanity'] = $qty;
                    store('cart_detail',$data);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    }
    function deleteAction(){
        if(!isset($_GET['id'])){die();}
        deleteProInCart($_GET['id'], $_GET['cart']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    function updateAction(){
        if(isset($_POST['update_cart']) && isset($_POST['apply_coupon'])){die();}
        foreach ($_POST['quanity'] as $prd_id => $qty) {
            updateCrad($qty,$_SESSION['cart'],$prd_id);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
