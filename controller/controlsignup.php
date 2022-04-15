<?php
include '../model/config.php';
//đăng kí
$user =$_POST['username'];
$pass =$_POST['password'];
$repass =$_POST['repassword'];
$email = $_POST['email'];
if (isset($user) || isset($pass) || isset($repass) || isset($email)){
    if (empty($user) || empty($pass) || empty($repass) || empty($email)){
        echo "Không được để trống";
    }else{
        $regex = preg_match("/^[_a-zA-Z0-9- ]+$/", $user);
                if($regex){ 
                    $sql1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE account ='$user'"));
                        if(strlen($user) > 5 && strlen($pass) > 7 && strlen($repass) > 7){
                            $pass = md5($pass);
                            $repass = md5($repass);
                             $sql2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE email ='$email'"));
                               if($sql2 == 0){
                                    if($sql1 < 1 && $pass == $repass){
                                        mysqli_query($conn, "INSERT INTO `user`( `account`, `pass`,`email`) VALUES ('$user','$pass','$email')" );
                                        echo 'Đăng ký thành công, Hãy <a href="login.php" style="color: #008f63; text-decoration: none;">đăng nhập</a>';
                                      }elseif($sql1 > 0){
                                          echo 'Tài khoản đã tồn tại';
                                      }else{
                                          echo 'Nhập lại mật khẩu';
                                      }
                               }else{
                                    echo 'Email đã được đăng ký.';
                               }
                        }else{
                            echo 'Tên đăng nhập phải trên 5 ký tự và mật khẩu phải trên 7 ký tự';
                            }
                }else{
                    echo "Không thể đặt dấu hoặc khoảng trắng trong tên người dùng";
                }
        }
}
  