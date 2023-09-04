<?php
    session_start();
    /**
     * ĐỊNH NGHĨA MỘT SỐ ĐƯỜNG DẪN CƠ SỞ
     */
    define('PATH_ROOT', __DIR__); ////C:htdocs\mvc\
    define('PATH_SYSTEM', __DIR__.'/system');//C:htdocs\mvc\system
    define('PATH_PUBLIC', __DIR__.'/public');//C:htdocs\mvc\public
    define('PATH_CONTROLLER', __DIR__.'/controller');//C:htdocs\mvc\controller
    define('PATH_VIEW',__DIR__.'/view');//C:htdocs\mvc\view
    define('PATH_MODEL', __DIR__.'/model');
    define('PATH_APPLICATION', PATH_CONTROLLER. '/admin/'); //C:htdocs\mvc\controller\admin
    define('PATH_SITE', PATH_CONTROLLER.'/site/');//C:htdocs\mvc\controller\site



    // Lấy thông số cấu hình
    require (PATH_SYSTEM . '/config/config.php');


    // Danh sách tham số gồm 2 phần
    //      - controller: controller hiện tại
    //      - action : action hiện tại
    $segment = array(
        'controller' => '',
        'action' => array()
    );


    // Nếu không truyền controller thì dùng controller mặc định
    // Dùng toán tử 3 ngôi so sánh có rỗng k? true thì CONTROLLER_DEFAULT còn false thì $_GET['c']
    $segment['controller'] = empty($_GET['c']) ? CONTROLLER_DEFAULT : $_GET['c'];
    // Action tương tự controller
    $segment['action'] = empty($_GET['a']) ? ACTION_DEFAULT : $_GET['a'];
    
    // unset($_SESSION['account']);

    // So sánh controller để xác định được Admin hay User
    require_once PATH_SYSTEM . '/core/loader/Controller.php';
    // Kiểm tra account đã đăng nhập hay chưa
    if( !isset($_SESSION['account']['level'])){
        // xác định vào trang user * chưa có SESSION['account']
        load( $segment['controller'], $segment['action'], PATH_SITE);
    }else{
        if($_SESSION['account']['level'] == 1 || $_SESSION['account']['level'] == 2){
            // xác định là tk admin
            load( $segment['controller'], $segment['action'], PATH_APPLICATION);
        }else{
            // xác định là tk user
            load( $segment['controller'], $segment['action'], PATH_SITE);
        }
    }
