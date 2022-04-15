<?php
include '../../model/config.php';
$user = $_GET['user'];
$noidung = $_GET['noidung'];
$list = $_GET['list'];
$ngayth = $_GET['ngayth'];
$pin = $_GET['pin'];
$idlist = $_GET['idlist'];
$data = array();
if (isset($user) || isset($noidung) || isset($ngayth) || isset($list)){
   $dateht = date('d-m-Y');
        if($ngayth >= $dateht && $pin == 0){
            mysqli_query($conn, "INSERT INTO `nhiemvu`(`id_list`,`idaccount`, `noidung`,`danhsach`, `checklist`, `ngayth`, `ngaythem`, `pin`) VALUES ('$idlist','$user','$noidung','$list','0','$ngayth','$dateht','0')");
            $data['success'] = true;
            $data['message'] = "Đã thêm việc thành công";
        }elseif($ngayth >= $dateht  && $pin == 1){
            mysqli_query($conn, "INSERT INTO `nhiemvu`(`id_list`,`idaccount`, `noidung`,`danhsach`, `checklist`, `ngayth`, `ngaythem`, `pin` ) VALUES ('$idlist','$user','$noidung','$list','0','$ngayth','$dateht','1')");
            $data['success'] = true;
            $data['message'] = "Đã thêm việc quan trọng thành công";
        }else{
            $data['success'] = false;
            $data['message'] = "Thêm việc thất bại";
        }
}else{
    $data['message'] = "Chưa nhập tài khoản và mật khẩu";
    $data['success']= false;
}

echo json_encode($data);
?>
