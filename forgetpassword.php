<?php
include 'model/config.php';
$error = '';
if(isset($_POST['submitforgotpass']) == true){
    $emailforgot = trim(htmlspecialchars(stripslashes(addslashes($_POST['emailforgot']))));
    $sql = mysqli_query($conn, "SELECT * FROM `user` WHERE `email` =  '$emailforgot'");
    $count = mysqli_num_rows($sql);
    if($count == 0){
       $error = 'Bạn chưa đăng ký thành viên';
    }else{
        $password = substr(sha1(rand(0,999999)), 0 , 7);
        $sql = mysqli_query($conn,"UPDATE `user` SET `pass`='$password' WHERE `email` = '$emailforgot'");
        $result = Sendnewpassword($emailforgot, $password);
        if($result == true){
            echo '<div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
            <!-- Then put toasts within -->
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <img src="asset/Icon.png" class="rounded me-2" width="35px">
                <strong class="me-auto">Cảnh báo</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                Bạn đã đổi mật khẩu thành công.
                </div>
            </div>
        </div>';
        }else{
            echo '<div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
            <!-- Then put toasts within -->
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <img src="asset/Icon.png" class="rounded me-2" width="35px">
                <strong class="me-auto">Cảnh báo</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                Đổi mật khẩu thất bại.
                </div>
            </div>
        </div>';
        }
    }
}
function Sendnewpassword($emailforgot, $password){
    require "PHPMailer-master/src/PHPMailer.php"; 
    require "PHPMailer-master/src/SMTP.php"; 
    require 'PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'kysutony1@gmail.com'; // SMTP username
        $mail->Password = 'huyhuyhuy';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom('kysutony@gmail.com', 'Tony' ); 
        $mail->addAddress($emailforgot); 
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Thư cấp lại mật khẩu';
        $noidungthu = "<p>Đây là thư cấp lại mật khẩu do bạn đã yêu cầu từ trang web 2dolist.website
        Đây là mật khẩu mới {$password}
        </p>"; 
        $mail->Body = $noidungthu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
       return true;
    } catch (Exception $e) {
        echo 'Error: ', $mail->ErrorInfo;
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    
</head>
<body>
    <!-- Content -->
    <?php
   if($error != ""){
   ?>
   <div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
       <!-- Then put toasts within -->
       <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
           <div class="toast-header">
           <img src="asset/Icon.png" class="rounded me-2" width="35px">
           <strong class="me-auto">Cảnh báo</strong>
           <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
           <div class="toast-body">
           <?=$error?>.
           </div>
       </div>
   </div>
   <?php
   }
   ?>
    <div class="container">
   
    <!-- <div id="result"></div> -->
    <div class="form-signin">
<div class="bg-soft-success">
  <div class="container content-space-1 content-space-t-md-3">
    <div class="mx-auto" style="max-width: 30rem;">
      <!-- Card -->
      <div class="card card-lg zi-2">
        <!-- Header -->
        <div class="card-header text-center">
          <h4 class="card-title">Quên mật khẩu?</h4>
          <p class="card-text">Nhập địa chỉ email bạn đã nhập lúc đăng ký, chúng tôi sẽ gửi mật khẩu mới đến mail của bạn.</p>
        </div>
        <!-- End Header -->

        <!-- Card Body -->
        <div class="card-body">
        <form action="forgetpassword.php" method="POST">
            <!-- Form -->
            <div class="mb-4">
              <label class="form-label" for="forgotPasswordFormEmail">Nhập email</label>
              
              <input type="email" class="form-control" name="emailforgot" value="<?php if (isset($emailforgot) == true) echo $emailforgot?>" placeholder="Hãy nhập địa chỉ email của bạn" aria-label="Enter your emaill address" required>
            </div>
            <!-- End Form -->

            <div class="d-grid mb-4">
              <button type="submit" class="btn btn-primary btn-lg button-login" name="submitforgotpass">Gửi</button>
            </div>
         
            <div class="text-center">
              <a href="login.php">
                <i class="bi-chevron-left small me-1"></i> Trở lại đăng nhập
              </a>
            </div>
          </form>
        </div>
        <!-- End Card Body -->
      </div>
      <!-- End Card -->
    </div>
  </div>
</div>
<!-- End Content -->
    </div>
    
    </div>
<!-- Shape -->
<style>
    body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 200px;
  padding-bottom: 100px;
  background-color: #f0f0f0;
}
a{
    color: #008f63;
    text-decoration: none;
  }
  a:hover{
    color: #008f63;
  }
.form-signin {
  width: 100%;
  padding: 15px;
  margin: auto;
}
.form-control:focus {
        border-color: #b5d8c9;
        outline: 0;
        box-shadow: 0 0 0 .25rem #b5d8c9;
    }
.form-signin .checkbox {
  font-weight: 400;
}
.form-label {
    margin-bottom: 0.5rem
;
    font-size: .875rem;
    font-weight: 500;
}
.button-login{
      padding: .375rem .75rem;
      color: #8e8e93;
      background-color: #008f63;
      border: none;
      color: #fff;
    }
    .button-login:hover{
      color: #fff;
      background-color: #027048;
    }
</style>
<!-- End Shape -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<script>
var toastLiveExample = document.getElementById('liveToast')
var toast = new bootstrap.Toast(toastLiveExample)
    toast.show()
</script>