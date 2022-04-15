<?php
include '../model/config.php';
  //thêm nv


  $noidung = $_POST['noidung'];
  $date = $_POST['day']; 
  $time = time();
  $date = mysqli_real_escape_string($conn,date("d-m-Y", strtotime($date)));
  $datethuchien = mysqli_real_escape_string($conn,date("Y-m-d", strtotime($date)));
  $dateht = date('d-m-Y');
  $pin = $_POST['pin'];

if(isset($noidung) || isset($date)){

    if($date >= $dateht){
       if($pin == 1){
        mysqli_query($conn, "INSERT INTO `nhiemvu`(`idaccount`, `noidung`, `checklist`,`ngayth`,`ngaythem` , `ngaythuchien`, `pin`) 
        VALUES ('$u','$noidung','0','$date', '$dateht','$datethuchien', '1')"); 
          echo "Đã thêm việc quan trọng thành công";
       }else{
        mysqli_query($conn, "INSERT INTO `nhiemvu`(`idaccount`, `noidung`, `checklist`,`ngayth`,`ngaythem` , `ngaythuchien`, `pin`) 
        VALUES ('$u','$noidung','0','$date', '$dateht','$datethuchien', '0')"); 
          echo "Đã thêm việc thành công";
            
            //  echo'<meta http-equiv="refresh" content="1;url= work.php">';
        
       }
    //    echo'<meta http-equiv="refresh" content="1;url= work.php">';
      }else{
        
            echo'Thêm nhiệm vụ thất bại!';
          
        
      } 
}else{
    echo 'Hãy điền đầy đủ thông tin!';
}
  