<?php
// connect DataBase
include_once PATH_SYSTEM . "/config/config.php";
// require Model
require_once PATH_SYSTEM . "/core/model/model.php";
function checkCard($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM `cart` c  WHERE c.client_id = $id";
    $query = mysqli_query($conn, $sql);
    return mysqli_num_rows($query);
}
function checkproincard($id, $card)
{
    $conn = getConnection();
    $sql = "SELECT * FROM `cart_detail` c WHERE c.product_detail_id = $id AND c.cart_id = $card";
    $query = mysqli_query($conn, $sql);
    return mysqli_num_rows($query);
}
function getProbyIDinCard($id, $card)
{
    $data = [];
    $conn = getConnection();
    $sql = "SELECT * FROM `cart_detail` c WHERE c.product_detail_id = $id AND c.cart_id = $card";
    // echo $sql;die();
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }
    return $data;
}
function updateCrad($qty, $card, $pro)
{
    $conn = getConnection();
    $sql = "UPDATE cart_detail SET quanity = '$qty' WHERE cart_id = $card AND product_detail_id = $pro";
    // echo $sql;die();
    mysqli_query($conn, $sql);
}
function totalRecordCard($id)
{
    $conn = getConnection();
    $sql = "SELECT d.* FROM `client` l 
        INNER JOIN `cart` c ON l.id = c.client_id
        INNER JOIN `cart_detail` d ON c.id = d.cart_id
        WHERE l.id = $id";
    $query = mysqli_query($conn, $sql);
    return mysqli_num_rows($query);
}
function deleteProInCart($id, $idCard)
{
    $conn = getConnection();
    $sql = "DELETE FROM `cart_detail` WHERE product_detail_id = $id AND cart_id = $idCard";
    // echo $sql; die();
    mysqli_query($conn, $sql);
}
function checkquanity($id, $qty)
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
    if($quanity < 0){
        $quanity = $data[0]['quanity'];
        $sql = "UPDATE `cart_detail` SET quanity = $quanity WHERE product_detail_id = $id";
        // echo $sql;die();
        $query = mysqli_query($conn, $sql);
    }
    closeConnection();
}
