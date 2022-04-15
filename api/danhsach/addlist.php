<?php
include '../../model/config.php';
$account = $_GET['account'];
$namelist = $_GET['namelist'];
$icon = $_GET['icon'];
$data = array();
if (isset($account) || isset($namelist) || isset($icon)){
        mysqli_query($conn, "INSERT INTO `danhsach`(`idaccount`, `tendanhsach`, `icon`) VALUES ('$account','$namelist','$icon')");
        $data['message'] = "Đã thêm danh sách thành công";
        $data['success']= true; 
            
}else{
    $data['message'] = "Thêm danh sách thất bại";
    $data['success']= false;
}
echo json_encode($data);
?>