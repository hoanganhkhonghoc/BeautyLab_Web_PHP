<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    require_once PATH_SYSTEM. "/core/helper/helper.php";
    // Get All Product in Product table
    function getAllValueFromProduct_detail($id){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT d.*, p.namePro FROM `product_detail` d
        INNER JOIN `product` p ON p.id = d.product_id
        WHERE d.isDeleted != 0 AND d.product_id = $id";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
        closeConnection();
        return $data;
    }
    function getAllProduct_detail($page){
        $data = [];
        $limit = 12;
        $current_page = $page;
        $totalRecords = getTotalRecord('product_detail');
        $totalPage = ceil($totalRecords/$limit);
        if($current_page < 1) {
            $current_page = 1;
        }
        if( $current_page > $totalPage && $totalRecords > 0) {
            $current_page = $totalPage;
        }
        $start = ($current_page - 1) * $limit;
        $conn = getConnection();
        $sql = "SELECT d.*, CONCAT(p.namePro,' ( ',d.color, ' )') AS 'namePro' FROM `product_detail` d
        INNER JOIN `product` p ON d.product_id = p.id
        WHERE d.isDeleted != 0 AND d.isSoid > 0 ORDER BY d.id DESC LIMIT $start, $limit";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data['product'][] = $row;
            }
        }else{
            $data['product'] = [];
        }
        $data['sl'] = mysqli_num_rows($query);
        $data['totalPage'] = $totalPage;
        closeConnection();
        return $data;
    }
    function likePro($client, $pro){
        $conn = getConnection();
        $sql = "SELECT l.* FROM `like` l WHERE l.client_id = $client AND l.product_detail_id = $pro AND l.isDeleted != 0";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) == 0){
            $sql1 = "INSERT INTO `like` (client_id, product_detail_id) values ($client,$pro)";
            // echo $sql1;
            mysqli_query($conn, $sql1);
        }else{
            $sql1 = "DELETE FROM `like` WHERE client_id = '$client' AND product_detail_id = '$pro'";
            // echo $sql1;
            mysqli_query($conn, $sql1);
        }
    }
    function getAllLike($page, $id){
        $data = [];
        $limit = 12;
        $current_page = $page;
        $totalRecords = getTotalRecord('product_detail');
        $totalPage = ceil($totalRecords/$limit);
        if($current_page < 1) {
            $current_page = 1;
        }
        if( $current_page > $totalPage && $totalRecords > 0) {
            $current_page = $totalPage;
        }
        $start = ($current_page - 1) * $limit;
        $conn = getConnection();
        $sql = "SELECT d.*, CONCAT(p.namePro,' ( ',d.color, ' )') AS 'namePro' FROM `like` l 
        INNER JOIN `product_detail` d ON d.id = l.product_detail_id
        INNER JOIN `client` c ON c.id = l.client_id
        INNER JOIN `product` p ON d.product_id = p.id
        WHERE l.client_id = $id  AND  d.isDeleted != 0 AND d.isSoid > 0 
        ORDER BY d.id DESC LIMIT $start, $limit";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data['product'][] = $row;
            }
        }else{
            $data['product'] = [];
        }
        $data['sl'] = mysqli_num_rows($query);
        $data['totalPage'] = $totalPage;
        closeConnection();
        return $data;
    }
    function getDetailProById($id){
        $conn = getConnection();
        $sql = "SELECT d.*, p.namePro , c.nameCate , p.cat_id FROM `product_detail` d 
        INNER JOIN `product` p ON p.id = d.product_id
        INNER JOIN `category` c ON c.id = p.cat_id
        WHERE d.id = $id AND d.isDeleted != 0 AND d.isSoid > 0";
        // echo $sql, die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }else{
            $data = [];
        }
        closeConnection();
        // echo "<pre>";
        // print_r($data);
        // die;
        return $data;
    }
    function get3DetailProDecs(){
        $conn = getConnection();
        $sql = "SELECT d.*, CONCAT(p.namePro, ' ( ', d.color , ' )') AS 'namePro' FROM `product_detail` d 
        INNER JOIN `product` p ON d.product_id = p.id
        WHERE d.isDeleted != 0 AND d.isSoid > 0 ORDER BY d.id DESC LIMIT 3";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }else{
            $data = [];
        }
        closeConnection();
        return $data;
    }
    function getAllProductWithCate($page,$id){
        $data = [];
        $limit = 12;
        $current_page = $page;
        $totalRecords = getTotalRecord('product_detail');
        $totalPage = ceil($totalRecords/$limit);
        if($current_page < 1) {
            $current_page = 1;
        }
        if( $current_page > $totalPage && $totalRecords > 0) {
            $current_page = $totalPage;
        }
        $start = ($current_page - 1) * $limit;
        $conn = getConnection();
        $sql = "SELECT d.*, CONCAT(p.namePro,' ( ',d.color, ' )') AS 'namePro' FROM `category` c
        INNER JOIN `product` p ON c.id = p.cat_id
        INNER JOIN `product_detail` d ON d.product_id = p.id
        WHERE c.id = $id AND d.isDeleted != 0 AND d.isSoid > 0 ORDER BY c.id DESC LIMIT $start, $limit";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $data['product'][] = $row;
            }
        }else{
            $data['product'] = [];
        }
        $data['sl'] = mysqli_num_rows($query);
        $data['recot'] = mysqli_num_rows($query);
        $data['totalPage'] = $totalPage;
        closeConnection();
        return $data;
    }
    function  getAllProductInCart($id){
        $conn = getConnection();
        $data = [];
        $sql = "SELECT CONCAT(p.namePro, ' ( ', d.color , ' )') AS 'namePro' , cd.price , cd.quanity , d.img, d.id, CONCAT(d.quanity) AS 'maxQuanity', CONCAT(c.id) AS 'idCard'
        FROM `cart` c 
        INNER JOIN `cart_detail` cd ON c.id = cd.cart_id 
        INNER JOIN `product_detail` d ON d.id = cd.product_detail_id 
        INNER JOIN `product` p ON p.id = d.product_id 
        WHERE c.client_id = $id AND d.isDeleted != 0 AND d.isSoid > 0";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
        return $data;
    }
