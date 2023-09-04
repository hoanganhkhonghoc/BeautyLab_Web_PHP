<?php
// connect DataBase
include_once PATH_SYSTEM . "/config/config.php";
// require Model
require_once PATH_SYSTEM . "/core/model/model.php";

function getReceiver($id)
{
    $data = [];
    $conn = getConnection();
    $sql = "SELECT * FROM `receiver` WHERE client_id = $id ORDER BY id DESC LIMIT 1";
    // echo $sql;die();
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    closeConnection();
    return $data[0]['id'];
}

function getIdCart($id)
{
    $data = [];
    $conn = getConnection();
    $sql = "SELECT id FROM `cart` WHERE client_id = $id";
    // echo $sql;die();
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    closeConnection();
    return $data[0]['id'];
}

function getAllCartDetailForCheckout($id)
{
    $data = [];
    $conn = getConnection();
    $sql = "SELECT * FROM `cart_detail` WHERE cart_id = $id";
    // echo $sql;die();
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    closeConnection();
    return $data;
}

function getIdOrderDECS($id)
{
    $data = [];
    $conn = getConnection();
    $sql = "SELECT * FROM `order` o WHERE o.client_id = $id ORDER BY id DESC LIMIT 1";
    // echo $sql;die();
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    closeConnection();
    return $data[0]['id'];
}

function update_quanity_product($id, $qty)
{
    $conn = getConnection();
    $sql = "SELECT quanity FROM `product_detail` WHERE id = $id";
    // echo $sql;die();
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    $quanity = $data[0]['quanity'] - $qty;

    $soid = 1;
    if ($quanity == 0) {
        $soid = 0;
    }
    if ($quanity <= 10 && $quanity > 0) {
        $soid = 2;
    }
    $sql = "UPDATE `product_detail` SET quanity = $quanity, isSoid = $soid WHERE id = $id";
    // echo $sql;die();
    $query = mysqli_query($conn, $sql);
    closeConnection();
}

function dropCart_detail($id, $cart){
    $conn = getConnection();
    $sql = "DELETE FROM `cart_detail` WHERE product_detail_id = $id AND cart_id = $cart";
    mysqli_query($conn, $sql);
}
