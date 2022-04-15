<?php
include '../../model/config.php';
$pin = $_GET['pin'];
$id = $_GET['id'];
$user = $_GET['user'];
$data = array();
if (isset($checklist) || isset($id)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$user' AND `id` = '$id'");
        if($sql1 > 0){
            mysqli_query($conn, "UPDATE `nhiemvu` SET `pin`= '$pin' WHERE `id` = '$id'");
            $data['message'] = "Dang nhap thanh cong";
            $data['success']= true;
         
        }else{
            $data['message'] = "sai ten dang nhap hoac mat khau";
            $data['success']= false;
        }
}else{
    $data['message'] = "chua nhap tai khoan mat khau";
    $data['success']= false;
}

echo json_encode($data);
?>