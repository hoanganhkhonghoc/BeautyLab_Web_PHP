<?php
    // Kết nối tới file config.php
    include_once "config.php";
    // Khai báo biến $conn là biến toàn cục 
    $conn = null;
    function getConnection(){
        // Gán giá trị cho biến $conn kết nối tới thông tin của DataBase
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // echo $conn ; die();
        // Kiểm tra $conn có rỗng không hay đơn giản có gán được giá trị từ thông số DataBase hay chưa
        if($conn == null){
            die("Kết nối thất bại: " . mysqli_connect_error());
        }
        // echo 'fghjk';
        // die();
        // Trả về DataBase
        return $conn;
    }
    // Hàm thêm tài khoản vô bảng account
    function insertAccount($name,$md5pass ,$email, $add,$sex ){
        $sql = "INSERT INTO account ( name , pass , email , address , sex, level ) 
                VALUES ( '$name' , '$md5pass' , '$email' , '$add' , '$sex', 2)";
        $conn = getConnection();
        mysqli_query($conn,$sql);
        // echo $sql;
    }
    // Hàm tìm tài khoản trả về  bản ghi
    function selectAccount($email, $md5){
        $conn = getConnection();
        $sql = "SELECT * FROM `client` WHERE email = '$email' AND pass = '$md5'  LIMIT  1";
        // echo $sql; die();
        $rs = mysqli_query($conn,$sql);
        if(mysqli_num_rows($rs) == 0){
            $sql = "SELECT * FROM `admin` WHERE email = '$email' AND pass = '$md5'  LIMIT  1";
            // echo $sql; die();
            $rs = mysqli_query($conn,$sql);
        }
        if(mysqli_num_rows($rs) == 0){
            $sql = "SELECT * FROM `staff` WHERE email = '$email' AND pass = '$md5'  LIMIT  1";
            // echo $sql; die();
            $rs = mysqli_query($conn,$sql);
        }
        // echo $rs; die();
        return $rs;
    }
    // Hàm tìm tài khoản (email) trả về bản ghi
    function selectColumAccount($colum,$value){
        $conn = getConnection();
        $sql = "SELECT * FROM `client` WHERE $colum = '$value' AND isDeleted != 0  LIMIT  1";
        // echo $sql; die();
        $rs = mysqli_query($conn,$sql);
        if(mysqli_num_rows($rs) == 0){
            $sql = "SELECT * FROM `admin` WHERE $colum = '$value' AND isDeleted != 0  LIMIT  1";
            // echo $sql; die();
            $rs = mysqli_query($conn,$sql);
        }
        if(mysqli_num_rows($rs) == 0){
            $sql = "SELECT * FROM `staff` WHERE $colum = '$value' AND isDeleted != 0  LIMIT  1";
            // echo $sql; die();
            $rs = mysqli_query($conn,$sql);
        }
        // echo mysqli_num_rows($rs); die();
        return $rs;
    }
    // Hàm update pass bảng account bằng email
    function updatePass($id, $pass){
        $sql = "UPDATE account SET pass = '$pass' WHERE id = '$id'";
        $conn = getConnection();
        mysqli_query($conn,$sql);
        echo $sql;
    }
    function closeConnection(){
        // Báo cho hiểu về $conn là biến toàn cục
        global $conn;
        if($conn){
            mysqli_close($conn);
        }
    }
?>