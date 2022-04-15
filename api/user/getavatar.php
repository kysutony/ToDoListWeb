
<?php
include '../../model/config.php';
$user = $_GET['user'];
$data = array();
if (isset($user)){

    $sql_q= mysqli_query($conn,"SELECT * FROM `user` WHERE account ='$user'");
    $sql1 = mysqli_num_rows($sql_q);

        if($sql1 > 0){
            $row = mysqli_fetch_array($sql_q);
            $data['avt'] = $row['avatar'];
            $data['success']= true;
        }
}

echo json_encode($data);
?>
