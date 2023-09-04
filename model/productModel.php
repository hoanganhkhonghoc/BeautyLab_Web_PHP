<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    // Get All Product in Product table
    function getAllValueFromProduct(){
        $data = [];
        $conn = getConnection();
        if($_SESSION['account']['level'] == 1){
            $id = 1;
            $colum = 'p.isDeleted';
        }else{
            $id = $_SESSION['account']['facilites'];
            $colum = 'f.id';
        }
        $sql = "SELECT p.*, c.nameCate, f.name FROM `product` p
        INNER JOIN `staff` s ON s.id = p.staff_id
        INNER JOIN `category` c ON c.id = p.cat_id
        INNER JOIN `facilities` f ON f.id = s.facilites_id
        WHERE $colum = $id AND p.isDeleted != 0 ORDER BY p.id DESC";
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
    // Get All Product in Product table in one Facilities
    function getAllProductInFacilites($id){
        $data = [];
        $conn = getConnection();
        $sql = "SELECT p.*, c.nameCate, f.name FROM `product` p
        INNER JOIN `staff` s ON s.id = p.staff_id
        INNER JOIN `category` c ON c.id = p.cat_id
        INNER JOIN `facilities` f ON f.id = s.facilites_id
        WHERE f.id = $id AND p.isDeleted != 0";
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
