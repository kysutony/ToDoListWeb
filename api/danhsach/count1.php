<?php
include '../../model/config.php';
$account = $_GET['account'];
$list = $_GET['list'];
$idlist = $_GET['idlist'];
$data = array();
if (isset($list)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `danhsach` = '$list' AND `id_list` = '$idlist' AND `idaccount` = '$account' AND `checklist` = 0");
    $row = mysqli_num_rows($sql1);
    $row1 = mysqli_fetch_array($row); 
    $data['message'] = $row;
    $data['success']= true;
}else{
    $data['message'] = "Ban chua dang nhap tai khoan hoac bai viet";
    $data['success']= false;
}

echo json_encode($data);
?>