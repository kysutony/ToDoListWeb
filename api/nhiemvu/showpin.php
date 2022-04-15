<?php
include '../../model/config.php';
$account = $_GET['account'];
$pin = $_GET['pin'];
$checklist = $_GET['checklist'];
$data = array();
if (isset($account) || isset($check)){

    $sql1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE idaccount ='$account' AND checklist = '$checklist' AND pin ='$pin'");

        if($sql1 > 0){
            while ($row = mysqli_fetch_object($sql1)){
            array_push($data, $row);
        }
        }else{
            $data['message'] = "ban chua co bai viet";
            $data['success']= false;
        }
}else{
    $data['message'] = "Ban chua dang nhap tai khoan";
    $data['success']= false;
}

echo json_encode($data);
?>
