<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    // Get All Client Account in Client table
    function getAccountByLevelAndID($level,$id){
        if($level == 1){
            $table = 'admin';
        }else{
            $table = 'staff';
        }
        $data = getById($table,$id,'id');
        return $data;
    }
