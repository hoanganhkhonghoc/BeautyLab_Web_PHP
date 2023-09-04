<?php
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    require_once PATH_SYSTEM. "/core/helper/helper.php";

    function sreachPro($key, $page, $cate){
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
        if($cate == 0){
            $sql = "SELECT d.*, CONCAT(p.namePro,' ( ',d.color, ' )') AS 'namePro' FROM `product_detail` d
                    INNER JOIN `product` p ON d.product_id = p.id
                    WHERE p.namePro LIKE '%$key%' AND d.isDeleted != 0 AND d.isSoid > 0 ORDER BY d.id DESC LIMIT $start, $limit";
        }else{
            $sql = "SELECT d.*, CONCAT(p.namePro,' ( ',d.color, ' )') AS 'namePro' FROM `category` c
                    INNER JOIN `product` p ON p.cat_id = c.id
                    INNER JOIN `product_detail` d ON d.product_id = p.id
                    WHERE c.id = $cate AND p.namePro LIKE '%$key%' AND d.isSoid > 0 AND d.isDeleted != 0
                    ORDER BY c.id DESC LIMIT $start, $limit";
        }
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
