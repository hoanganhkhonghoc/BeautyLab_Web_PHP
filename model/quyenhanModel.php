<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    require_once PATH_SYSTEM. "/core/helper/helper.php";

    function checkQuyenStaff($id){
        $conn = getConnection();
        $sql = "SELECT * FROM `Quyen_han` WHERE staff_id = $id";
        $query = mysqli_query($conn, $sql);
        return mysqli_num_rows($query);
    }