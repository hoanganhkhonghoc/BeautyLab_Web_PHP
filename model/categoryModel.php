<?php 
    // connect DataBase
    include_once PATH_SYSTEM . "/config/config.php";
    // require Model
    require_once PATH_SYSTEM. "/core/model/model.php";
    // Get All Category in Category table
    function getAllValueFromCategory(){
        $data = getAll('category');
        return $data;
    }
    // Get Category by id
    function getCategoryById($id){
        $data = getById('category',$id,'id');
        return $data;
    }
