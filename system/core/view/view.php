<?php
    // $master là biến chung cho cả admin và user nên khai báo biến để sử dụng chung
    function loadView($master,$view, $data = null){
        if($_SESSION['account']['level'] == 1 || $_SESSION['account']['level'] == 2){
            require_once PATH_VIEW.'/admin/'.$master.'.php'; //admin
        }else{
            require_once PATH_VIEW.'/site/'.$master.'.php';  //user
        }
    }
?>