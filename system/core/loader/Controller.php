<?php
    if(!defined('PATH_SYSTEM')) die ('Bad requested');
    function load($controller ,$action, $path){
        // Chuyển đổi tên controller vì nó có định dạng là ( Name )Controller : ProductController
        // VD: c = Product => strtolower() => product => ucfirst() => Product => ProductController
        $controller = ucfirst(strtolower($controller)) . 'Controller';
        // Chuyển đổi tên action vì nó có định dạng ( Name )Action : indexAction
        $action = strtolower($action) . 'Action';
        // Kiểm tra file controller có tên tồn tại hay không
        if( !file_exists($path . $controller . '.php')){
            die('Controller không tồn tại');
        }
        require_once $path . $controller . '.php';

        if( !function_exists($action)){
            die('Action không tồn tại');
        }

        $action(); 
    }
?>