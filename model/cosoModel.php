<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";

    function getAllCo_so(){
        $data = getAll('facilities');
        return $data;
    }
