<?php
include '../../model/config.php';
$account = $_GET['account'];
$status = $_GET['status'];
$data = array();

if (isset($account)){
    $sql1 = mysqli_query($conn, "SELECT COUNT(*) AS tong FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0 AND `pin` = 1");
    $row = mysqli_fetch_array($sql1);
    $data['message'] = $row['tong'];
    $data['success']= true;
}else{
    $data['message'] = "Ban chua dang nhap tai khoan hoac bai viet";
    $data['success']= false;
}
echo json_encode($data);
?>