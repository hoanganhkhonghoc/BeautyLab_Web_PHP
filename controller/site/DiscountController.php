<?php
// load web
require_once PATH_SYSTEM . '/core/view/view.php';
// require_once model
require_once PATH_MODEL . '/discountModel.php';

function indexAction()
{
    if (isset($_POST['apply_coupon'])) {
        $data = selecDiscount($_POST['coupon_code']);
        // echo "<pre>";
        // print_r($data);
        // die;
        if ($data == null) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['checkcodediscount'] = $data[0]['code'];
            if ($data[0]['percent'] == 0 && $data[0]['money'] != 0) {
                $_SESSION['money'] = $data[0]['money'];
            }
            if ($data[0]['percent'] != 0 && $data[0]['money'] == 0) {
                $_SESSION['percent'] = $data[0]['percent'];
            }
            $_SESSION['magiamgia'] = 'Chỉ áp dụng 1 mã giảm giá';
            // echo $data[0]['id']; die();
            $_SESSION['discount']['id'] = $data[0]['id'];
            // echo "hh";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        if (isset($_POST['unset'])) {
            unset($_SESSION['checkcodediscount']);
            unset($_SESSION['money']);
            unset($_SESSION['percent']);
            unset($_SESSION['magiamgia']);
            // echo 'jj';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            die();
        }
    }
}
