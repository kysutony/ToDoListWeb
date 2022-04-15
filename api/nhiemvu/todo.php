<?php
include '../../model/config.php';
$account = $_GET['account'];
$check = $_GET['check'];
$list = $_GET['list'];
$idlist = $_GET['idlist'];
$data = array();
if (isset($account) || isset($check)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE idaccount ='$account'AND `id_list` = '$idlist' AND danhsach = '$list' AND checklist = '$check'");
        
        if($sql1 > 0){
            while ($row = mysqli_fetch_object($sql1)){
            array_push($data, $row);
        }
        }else{
            $data['message'] = "ban chua co bai viet";
            $data['success']= false;
        }
}else{
    $data['message'] = "Ban chua dang nhap tai khoan hoac bai viet";
    $data['success']= false;
}

echo json_encode($data);
?>