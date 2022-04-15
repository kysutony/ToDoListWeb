<?php
include '../../model/config.php';
$id = $_GET['id'];
$account = $_GET['account'];
$namelist = $_GET['namelist'];
$newnamelist = $_GET['newnamelist'];
$icon = $_GET['icon'];
$data = array();
if (isset($account) || isset($namelist) || isset($icon)){
            mysqli_query($conn, "UPDATE `nhiemvu` SET `danhsach`='$newnamelist' WHERE `idaccount` = '$account' AND `danhsach` = '$namelist'");
            mysqli_query($conn, "UPDATE `danhsach` SET `tendanhsach`='$newnamelist',`icon`='$icon' WHERE `id` = '$id' AND `idaccount` = '$account'");
            $data['message'] = "Cập nhật danh sách thành công";
            $data['success']= true;
}else{
    $data['message'] = "Cập nhật danh sách thất bại";
    $data['success']= false;
}
echo json_encode($data);
?>