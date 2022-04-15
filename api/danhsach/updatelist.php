<?php
include '../../model/config.php';
$account = $_GET['account'];
$data = array();

    
    $sql1 = mysqli_query($conn, "SELECT danhsach FROM danhsach JOIN nhiemvu ON danhsach.tendanhsach = nhiemvu.danhsach AND danhsach.idaccount = '$account'");
    $row = mysqli_fetch_array($sql1);
    
    $data['message'] = $row['tong'];
    $data['success']= true;


echo array_count_values($row);
?>