<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    
    function sreachLike($id, $client){
        $conn = getConnection();
        $sql = "SELECT * FROM `like` WHERE product_detail_id = $id AND client_id = $client";
        // echo $sql;die();
        $query = mysqli_query($conn, $sql);
        return mysqli_num_rows($query);
    }
    function getAllLikeById($id){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT * FROM `like` WHERE client_id = $id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
        return $data;
    }
