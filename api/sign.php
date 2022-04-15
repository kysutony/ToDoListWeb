<?php
include '../model/config.php';
$user = strtolower($_GET['user']);
$pass = strtolower($_GET['pass']);
$data = array();
if (isset($user) || isset($pass)){
    $sql = mysqli_fetch_array(mysqli_query($conn, "SELECT `pass` FROM `user` WHERE `account` ='$user' AND `pass` ='$pass'"));
    if(strlen($sql['pass']) == 7 ){
    $sql_q= mysqli_query($conn,"SELECT * FROM `user` WHERE account ='$user' AND pass='$pass'");
    $sql1 = mysqli_num_rows($sql_q);
    $regex = preg_match("/^[_a-zA-Z0-9- ]+$/", $user);
    if($regex){
        if($sql1 > 0){
            $row = mysqli_fetch_array($sql_q);
            $data['message'] = "Đăng nhập thành công";
            $data['success']= true;

        }else{
            $data['message'] = "Sai tên đăng nhập hoặc mật khẩu";
            $data['success']= false;
        }
    }else{
        $data['message'] = "Không thể đặt dấu hoặc khoảng trắng trong tên người dùng";
        $data['success']= false;
    }
    }else{
    $pass = md5($pass);
    $sql_q= mysqli_query($conn,"SELECT * FROM `user` WHERE account = '$user' AND pass='$pass'");
    $sql1 = mysqli_num_rows($sql_q);
    $regex = preg_match("/^[_a-zA-Z0-9- ]+$/", $user);
    if($regex){
        if($sql1 > 0){
            $row = mysqli_fetch_array($sql_q);
            $data['message'] = "Đăng nhập thành công";
            $data['success']= true;

        }else{
            $data['message'] = "Sai tên đăng nhập hoặc mật khẩu";
            $data['success']= false;
        }
    }else{
    $data['message'] = "Không thể đặt dấu hoặc khoảng trắng trong tên người dùng";
    $data['success']= false;
    }
    }
}else{
    $data['message'] = "Chưa nhập tên đăng nhập hoặc mật khẩu";
    $data['success']= false;
}

echo json_encode($data);
?>
