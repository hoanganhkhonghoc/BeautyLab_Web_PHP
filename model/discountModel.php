<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";

    function selecDiscount($key){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT * FROM `discount_code` WHERE code = '$key' AND isDeleted != 0";
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