<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    // Get All Client Account in Client table
    function getAllValueFromClient(){
        $data = getAll('client');
        return $data;
    }
