<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    function getAllCommentById($id){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT c.*, l.name FROM `comment` c
        INNER JOIN `client` l ON c.client_id = l.id
        WHERE c.product_detail_id = $id AND c.isDeleted != 0 AND l.isDeleted != 0 ORDER BY c.id DESC";
        // echo $sql;die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
        closeConnection();
        return $data;
    }
    function getTotalRecordById($id){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT * FROM `comment` WHERE product_detail_id = $id AND isDeleted != 0";
        // echo $sql;die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
        closeConnection();
        return mysqli_num_rows($query);
    }
    function getAllComment(){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT comment.id, comment.content,comment.product_detail_id, client.name, client.phone, client.email, product_detail.img, product.namePro FROM `comment` INNER JOIN `client` on comment.client_id = client.id
        INNER JOIN `product_detail` on product_detail.id = comment.product_detail_id
        INNER JOIN `product` on product.id = product_detail.product_id
        order BY comment.id DESC";
        // echo $sql;die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
        closeConnection();
        return $data;
    }
