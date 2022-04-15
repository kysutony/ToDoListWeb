<?php
include '../model/config.php';
if (!isset($_POST['username'])){
  die('');
}
$user = addslashes($_POST['username']);
$pass = addslashes($_POST['password']);
if (empty($user) || empty($pass)){
  echo"Không được để trống!";
}else{
  $sql = mysqli_fetch_array(mysqli_query($conn, "SELECT `pass` FROM `user` WHERE `account` ='$user' AND `pass` ='$pass'"));
  if(strlen($sql['pass']) == 7 ){
    $sql = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE `account` ='$user' AND `pass` ='$pass'"));
    $sql1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE `account` ='$user' AND `permission` = 1"));
        if($sql > 0){
          if($sql1 > 0){
            setcookie("user", $user, time() + (86400 * 30) ,('/'));
            setcookie("userpermission", '1', time() + (86400 * 30) ,('/'));
            setcookie("adminpermission", '1', time() + (86400 * 30) ,('/'));
            echo 'Đăng nhập thành công';
            echo '<script>window.location.href="admin/";</script>';
          }else{
            setcookie("user", $user, time() + (86400 * 30) ,('/'));
            setcookie("userpermission", '1', time() + (86400 * 30) ,('/'));
            echo "Đăng nhập thành công";
            echo '<script>window.location.href="index.php";</script>';
          }
        }else{
          echo 'Sai tài khoản và mật khẩu!';
          
        }
  }else{
    $pass = md5($pass);
    $sql = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE `account` ='$user' AND `pass` ='$pass'"));
    $sql1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE `account` ='$user' AND `permission` = 1"));
        if($sql > 0){
          if($sql1 > 0){
            setcookie("user", $user, time() + (86400 * 30) ,('/'));
            setcookie("userpermission", '1', time() + (86400 * 30) ,('/'));
            setcookie("adminpermission", '1', time() + (86400 * 30) ,('/'));
            echo 'Đăng nhập thành công';
            echo '<script>window.location.href="admin/";</script>';
          }else{
            setcookie("user", $user, time() + (86400 * 30) ,('/'));
            setcookie("userpermission", '1', time() + (86400 * 30) ,('/'));
            echo "Đăng nhập thành công";
            echo '<script>window.location.href="index.php";</script>';
          }
        }else{
          echo 'Sai tài khoản và mật khẩu!';
          
        }
  }
  
}
?>