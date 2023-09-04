<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    require_once PATH_SYSTEM. "/core/helper/helper.php";

    function getOrderByIdClient($id){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT * FROM `order` o WHERE o.client_id = $id AND o.isDeleted != 0 ORDER BY o.id DESC";
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

    function getProInOrder($id, $idacc){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT pd.id, pd.img, pd.color, p.namePro, d.quanity, d.price FROM `order` o
        INNER JOIN `order_detail` d ON o.id = d.order_id
        INNER JOIN `product_detail` pd ON pd.id = d.product_id
        INNER JOIN `product` p ON p.id = pd.product_id
        WHERE o.id = $id AND o.client_id = $idacc";
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

    function getAllOrder($phan){
        $data = [];
        $conn = getConnection();
        $cau_lenh = "";
        switch($phan){
            case 0:
                $cau_lenh = "AND status = 0";break;
            case 1:
                $cau_lenh = "AND status = 1";break;
            case 2:
                $cau_lenh = "";break;
            case 3:
                $cau_lenh = "AND status = 2"; break;
        }
        $sql = "SELECT * FROM `order` WHERE isDeleted != 0 $cau_lenh";
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