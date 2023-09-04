<?php 
    if($_SESSION['account']['level'] > 2){
        die(header("location:view/admin/error/404.php"));
    }
    // load web
    require_once PATH_SYSTEM.'/core/view/view.php';
    // add model
    require_once PATH_MODEL. '/appointmentModel.php';
    /* 
        url: index.php?c=appointment&a=index&month= (month now)
        $data['date'] all time 
        Load: appointment-list
    */
    function indexAction(){
        $data = [];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['date'] = getdate();
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Appointment/appointment-list',$data);
    }
    /* 
        url: index.php?c=appointment&a=xl_xemlich&month= (month now)
        $data['date'] all time 
        Navigation: index.php?c=appointment&a=index&month= $_POST
    */
    function xl_xemlichAction(){
        if(!isset($_POST['month'])){
            die();
        }
        $id = $_POST['month'];
        header("location: index.php?c=appointment&a=index&month=$id");
    }
    /* 
        url: index.php?c=appointment&a=show&day= ($_GET)
        $data['appointment'] = get all appointment by day and facilities
        Load: appointment-show
    */
    function showAction(){
        if(!isset($_GET['day']) || !isset($_GET['month'])){
            die();
        }
        $data = [];
        $data['appointment'] = getAllAppointmentInAppointment($_GET['day'], $_GET['month']);
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Appointment/appointment-show',$data);
    }
    /* 
        url: index.php?c=appointment&a=delete&id= ??
        Navigation: index.php?c=appointment&a=index&month= $_POST
    */
    function deleteAction(){
        if(!isset($_GET['id']) || !isset($_GET['day'])){
            die();
        }
        deleteRecordById('appointment','id',$_GET['id']);
        $data['appointment'] = getAllAppointmentInAppointment($_GET['day'], $_GET['month']);
        // echo "<pre>";
        // print_r($data);
        // die;
        loadView('master','Appointment/appointment-show',$data);
    }
    function addAction(){
        $data = [];
        loadView('master','Appointment/appointment-add',$data);
    }
