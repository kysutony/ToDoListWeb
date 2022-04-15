<?php
include '../../model/config.php';
$user = $_GET['user'];
$data = array();
if (isset($user)){
    
    $sql_q = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$user' AND checklist=1");
    $sql1 = mysqli_num_rows($sql_q);
        if($sql1 > 0){
            mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `idaccount` = '$user' AND checklist=1");
            $data['message'] = "Đã xoá nhiệm vụ đã hoàn thành";
            $data['success']= true;
         
        }else{
            $data['message'] = "Không có việc đã hoàn thành";
            $data['success']= false;
        }
}else{
    $data['message'] = "Chưa đăng nhập";
    $data['success']= false;
}

echo json_encode($data);
?>