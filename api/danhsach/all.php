<?php
include '../../model/config.php';
$account = $_GET['account'];
$data = array();
if (isset($account)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `danhsach` WHERE idaccount ='$account'");
    
        while ($row = mysqli_fetch_object($sql1)){
            array_push($data, $row);
            
        }
        
        
}else{
    $data['message'] = "Ban chua dang nhap tai khoan hoac bai viet";
    $data['success']= false;
}

echo json_encode($data);
?>