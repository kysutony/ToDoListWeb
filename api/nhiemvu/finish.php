<?php
include '../../model/config.php';
$checklist = $_GET['check'];
$id = $_GET['id'];
$user = $_GET['user'];
$data = array();
if (isset($checklist) || isset($id)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$user' AND `id` = '$id'");
        if($sql1 > 0){
            mysqli_query($conn, "UPDATE `nhiemvu` SET `checklist`= 1 WHERE `id` = '$id'");
            $data['success']= true;
         
        }else{
            $data['message'] = "chua co bai viet";
            $data['success']= false;
        }
}else{
    $data['message'] = "chua nhap tai khoan mat khau";
    $data['success']= false;
}

echo json_encode($data);
?>