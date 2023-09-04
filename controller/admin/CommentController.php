<?php 
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load web
    require_once PATH_SYSTEM.'/core/view/view.php';
    require_once PATH_MODEL. '/commentModel.php';

    function indexAction(){
        $data = getAllComment();
        // echo '<pre>';
        // print_r($data);
        // die();
        loadView('master','Comment/comment_list',$data);
    }