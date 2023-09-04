<?php 
    require_once PATH_SYSTEM.'/config/db.php';
    
    function getTotalRecord($table) {
        $conn = getConnection();
        $sqlProduct = "SELECT * FROM `$table` WHERE isDeleted != 0";
        // echo $sqlProduct;
        // die;
        $queryProduct = mysqli_query($conn, $sqlProduct);
        $totalRecords = mysqli_num_rows($queryProduct);
        closeConnection();
        return $totalRecords;
    }
    function updateOrder($id, $status){
        $conn = getConnection();
        $sql = "UPDATE `order` SET status = $status WHERE id = $id";
        mysqli_query($conn, $sql);
        $sql1 = "SELECT * FROM `order_detail` WHERE `order_id` = $id";
        $query = mysqli_query($conn, $sql1);
        if($status == 0){
            if(mysqli_num_rows($query) > 0) {
                while($row = mysqli_fetch_assoc($query)) {
                    $data[] = $row;
                }
            }else{
                $data = [];
            }
            foreach($data AS $pro){
                $product_detail = getById('product_detail', $pro['product_id'], 'id');
                $quanity = $product_detail['quanity'] + $pro['quanity'];
                if($quanity >= 10){
                    $soid = 1;
                }else if($quanity < 10 && $quanity > 0){
                    $soid = 2;
                }else{
                    $soid = 0;
                }
                $idpro = $pro['product_id'];
                $sql2 = "UPDATE product_detail SET quanity = $quanity , isSoid = $soid WHERE id = $idpro";
                // echo $sql2; die();
                mysqli_query($conn, $sql2);
                // echo "<pre>";
                // print_r($product_detail);
                // echo $quanity;
                // die;    
            }
        }
        // echo $sql;die();
        closeConnection();
    }