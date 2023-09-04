<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    // Get All Facilities in Facilities table
    function getAllValueFromFacilities(){
        $data = getAll('facilities');
        return $data;
    }
