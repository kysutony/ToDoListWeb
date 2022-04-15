<?php
include '../../model/config.php';
$user = $_GET['user'];
$list = $_GET['list'];
$idlist = $_GET['idlist'];
$data = array();
if (isset($user) || isset($list) || isset($idlist)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `danhsach` WHERE `id` = '$idlist' AND `idaccount` = '$user' AND `tendanhsach` = '$list'");
    $sql2 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `id_list` = '$idlist' AND `idaccount` = '$user' AND `danhsach` = '$list'");
        if($sql1 > 0){
            mysqli_query($conn, "DELETE FROM `danhsach` WHERE `id` = '$idlist' AND `idaccount` = '$user' AND `tendanhsach` = '$list'");
            mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `id_list` = '$idlist' AND `idaccount` = '$user' AND `danhsach` = '$list'");
            $data['message'] = "Đã xoá thành công";
            $data['success']= true;
         
        }else{
            $data['message'] = "Sai tên đăng nhập và mật khẩu";
            $data['success']= false;
        }
}else{
    $data['message'] = "Chưa nhập thông tin đầy đủ";
    $data['success']= false;
}

echo json_encode($data);
?>