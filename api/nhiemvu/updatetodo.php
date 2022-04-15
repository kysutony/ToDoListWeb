<?php
include '../../model/config.php';
$id = $_GET['id'];
$user = $_GET['user'];
$noidung = $_GET['noidung'];
$ngayth = $_GET['ngayth'];
$pin = $_GET['pin'];
$data = array();
if (isset($id) || isset($user) || isset($noidung) || isset($ngayth) || isset($list)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$user' AND `id` = '$id'");
        if($sql1 > 0){
            mysqli_query($conn, "UPDATE `nhiemvu` SET `noidung`='$noidung',`ngayth`='$ngayth',`pin`='$pin' WHERE `idaccount` = '$user' AND `id` = '$id'");
            $data['success']= true;
          $data['message'] = "Cập nhật thành công";
        }else{
            $data['message'] = "Cập nhật thất bại";
            $data['success']= false;
        }
}else{
    $data['message'] = "Chưa nhập đầy đủ thông tin";
    $data['success']= false;
}

echo json_encode($data);
?>