<?php
include '../../model/config.php';
$user = $_GET['user'];
$avatar = $_GET['avatar'];
$email = $_GET['email'];
$newpass = strtolower($_GET['password']);
$data = array();

if (isset($user) && isset($avatar) && isset($email)){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $data['message'] = "Bạn nhập không đúng fortmat email";
      $data['success']= false;
    }else{
         $sql2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE account = '$user' AND email ='$email'"));
         if($sql2 == 0){
             $sql1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE email ='$email'"));
        if($sql1 == 0){
                if($newpass == ""){
                        $query = mysqli_query($conn, "UPDATE `user` SET `avatar`='$avatar',`email`='$email' WHERE `account`= '$user'");
                        if($query){
                        $data['message'] = "Cập nhật thành công";
                        $data['success']= true;    
                        }else{
                        $data['message'] = "Đã có lỗi";
                        $data['success']= false;
                        }
                }else{
                    if($newpass > 7){
                        $data['message'] = "Mật khẩu của bạn phải trên 7 ký tự";
                        $data['success']= false;
                    }else{
                        $newpass = md5($newpass);
                        $query = mysqli_query($conn, "UPDATE `user` SET `avatar`='$avatar',`email`='$email', `pass`='$newpass' WHERE `account`= '$user'");
                        if($query){
                        $data['message'] = "Cập nhật thành công";
                        $data['success']= true;    
                        }else{
                        $data['message'] = "Đã có lỗi";
                        $data['success']= false;
                        }
                    }
                }
        }else{
        $data['message'] = "Email của bạn đã được sử dụng";
        $data['success']= false;
        }
         }else{
              if($newpass == ""){
                        $query = mysqli_query($conn, "UPDATE `user` SET `avatar`='$avatar',`email`='$email' WHERE `account`= '$user'");
                        if($query){
                        $data['message'] = "Cập nhật thành công";
                        $data['success']= true;    
                        }else{
                        $data['message'] = "Đã có lỗi";
                        $data['success']= false;
                        }
                }else{
                    if($newpass > 7){
                        $data['message'] = "Mật khẩu của bạn phải trên 7 ký tự";
                        $data['success']= false;
                    }else{
                        $newpass = md5($newpass);
                        $query = mysqli_query($conn, "UPDATE `user` SET `avatar`='$avatar',`email`='$email', `pass`='$newpass' WHERE `account`= '$user'");
                        if($query){
                        $data['message'] = "Cập nhật thành công";
                        $data['success']= true;    
                        }else{
                        $data['message'] = "Đã có lỗi";
                        $data['success']= false;
                        }
                    }
                }
         }
    }
}else{
    $data['message'] = "Bạn chưa nhập đủ giá trị";
    $data['success']= false;
}
echo json_encode($data);
?>