<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    // Get All Category in Category table
    
    function getAllAppointmentInAppointment($day , $month){
        $data = [];
        $conn = getConnection();
        if($_SESSION['account']['level'] == 1){
            $id = 1;
            $colum = 'f.isDeleted';
        }else{
            $id = $_SESSION['account']['facilites'];
            $colum = 'f.id';
        }
        $sql = "SELECT a.*, CONCAT(f.name) AS 'f_name' FROM appointment a
        INNER JOIN facilities f ON a.facilities_id = f.id
        WHERE a.isDeleted != 0 AND $colum = $id AND DAY(a.date) = $day AND MONTH(a.date) = $month";
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
