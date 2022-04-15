<?php
include '../../model/config.php';
$user = strtolower($_GET['user']);
$pass = strtolower($_GET['pass']);
$re_pass = strtolower($_GET['repass']);
$email = strtolower($_GET['email']);
$data = array();

if (isset($user) || isset($pass) || isset($re_pass) || isset($email)){
        if(empty($user) || empty($pass) || empty($re_pass) || empty($email)){
            $data['message'] = "Không được để trống";
            $data['success']= false;
        }else{
            $regex = preg_match("/^[_a-zA-Z0-9- ]+$/", $user);
                if($regex){
                     $sql1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE account ='$user'"));
                     
                        if(strlen($user) > 5 && strlen($pass) > 7 && strlen($re_pass) > 7){
                            $pass = md5($pass);
                            $re_pass = md5($re_pass);
                            if($sql1 < 1 && $pass == $re_pass){
                                $sql2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE email ='$email'"));
                               if($sql2 == 0){
                                    $query = mysqli_query($conn, "INSERT INTO `user`( `account`, `pass`,`permission`,`email`) VALUES ('$user','$pass','0','$email')" );
                                if($query){
                                    $data['message'] = "Đăng ký thành công";
                                    $data['success']= true;
                                }else{
                                    $data['message'] = "Đăng ký thất bại";
                                    $data['success']= false;
                                }
                               }else{
                                   $data['message'] = "Email của bạn đã được đăng ký";
                                    $data['success']= false;
                               }
                                
                            }elseif($sql1 > 0){
                                $data['message'] = "Tài khoản đã tồn tại";
                                $data['success']= false;
                            }else{
                                $data['message'] = "Nhập lại mật khẩu";
                                $data['success']= false;
                            }
                        }else{
                            $data['message'] = "Tên đăng nhập phải trên 5 ký tự và mật khẩu phải trên 7 ký tự";
                            $data['success']= false;
                        }
                }else{
                    $data['message'] = "Không thể đặt dấu hoặc khoảng trắng trong tên người dùng";
                    $data['success']= false;
                }
        }
}
echo json_encode($data);
?>
