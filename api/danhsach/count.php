<?php
include '../../model/config.php';
$account = $_GET['account'];
$list = $_GET['list'];
$data = array();
if (isset($list)){
    
    $sql1 = mysqli_query($conn, "SELECT COUNT(danhsach) AS tong FROM `nhiemvu` WHERE idaccount= '$account' and danhsach = '$list' AND `checklist` = 0");
    $row = mysqli_fetch_array($sql1);
    $data['message'] = $row['tong'];
    $data['success']= true;
}else{
    $data['message'] = "Ban chua dang nhap tai khoan hoac bai viet";
    $data['success']= false;
}

echo json_encode($data);
?>