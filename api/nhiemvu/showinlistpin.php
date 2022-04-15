<?php
include '../../model/config.php';
$account = $_GET['account'];
$check = $_GET['check'];
$pin = $_GET['pin'];
$data = array();
if (isset($account) || isset($check)){
    
    $sql1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE idaccount ='$account' AND checklist = '$check' AND pin ='$pin'");
        
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