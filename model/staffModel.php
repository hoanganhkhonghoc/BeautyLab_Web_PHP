<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    // Get All Client Account in Client table
    function getAllValueFromStaff(){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT S.*, CONCAT(f.name) AS 'f_name' FROM `staff` s 
        INNER JOIN `facilities` f ON s.facilites_id = f.id
        WHERE s.isDeleted != 0";
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
