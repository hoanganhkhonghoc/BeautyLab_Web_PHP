<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";

    function get5ProductInOrder(){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT SUM(o.quanity * o.price) AS total_price, d.id, p.namePro, d.img, SUM(o.quanity) AS total_quanity
        FROM order_detail o
        INNER JOIN `product_detail` d ON o.product_id = d.id
        INNER JOIN `product` p ON p.id = d.product_id
        GROUP BY o.product_id
        order by SUM(o.quanity) DESC LIMIT 5";
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
    function getDonHang(){
        $conn = getConnection();
        $sql = "SELECT *
        FROM `order`
        WHERE MONTH(date_order) = MONTH(CURRENT_DATE())
          AND YEAR(date_order) = YEAR(CURRENT_DATE());";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        $thang_ht = mysqli_num_rows($query);
        $sql2 = "SELECT *
        FROM `order`
        WHERE MONTH(date_order) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
          AND YEAR(date_order) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH);";
        // echo $sql; die();
        $query2 = mysqli_query($conn, $sql2);
        $thang_truoc = mysqli_num_rows($query2);
        // echo $thang_truoc; die();
        return $thang_ht - $thang_truoc;
    }
    function getTongDon(){
        $conn = getConnection();
        $sql = "SELECT *
        FROM `order`
        WHERE MONTH(date_order) = MONTH(CURRENT_DATE())
          AND YEAR(date_order) = YEAR(CURRENT_DATE());";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        $thang_ht = mysqli_num_rows($query);
        return $thang_ht;
    }
    function doanhthu(){
        $conn = getConnection();
        $sql = "SELECT SUM(sum_total) AS total_sum
        FROM `order`
        WHERE MONTH(date_order) = MONTH(CURRENT_DATE())
          AND YEAR(date_order) = YEAR(CURRENT_DATE());";
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
    function donHangCanXuLy($phan){
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
        $query = mysqli_query($conn, $sql);
        return mysqli_num_rows($query);
    }
    function getSanPhamSapHet(){
        $conn = getConnection();
        $sql = "SELECT *
        FROM product_detail
        WHERE quanity <= 10";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        
        return mysqli_num_rows($query);
    }
    function getSanPhamdaHet(){
        $conn = getConnection();
        $sql = "SELECT *
        FROM product_detail
        WHERE quanity = 0";
        // echo $sql; die();
        $query = mysqli_query($conn, $sql);
        
        return mysqli_num_rows($query);
    }