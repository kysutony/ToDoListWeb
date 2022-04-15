<?php
include 'include/head.php';
if(empty($_COOKIE["userpermission"]) && empty($_COOKIE["user"]) && empty($_COOKIE["pass"])){ 

?>
<div class="container" style="margin-top: 50px;">
<div class="text-center">
    <div id="carouselExampleInterval" class="carousel carousel-fade slide" data-bs-ride="carousel">
  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
        <img src="asset/image/c.png" class="d-block w-50 mx-auto" >
      
    </div>
    <div class="carousel-item" data-bs-interval="5000">
        <img src="asset/image/done-5.png" class="d-block w-50 mx-auto">
      
    </div>
    <div class="carousel-item"  data-bs-interval="5000">
        <img src="asset/image/d.png" class="d-block w-50 mx-auto">
      
    </div>
  </div>
  
</div>
              <div class="mb-3">
                  <h5>To Do List</h5>
                  <p>Giúp bạn hoàn thành công việc nhanh chóng, thuận tiện, tiết kiệm thời gian của bạn.</p>
              </div>
                
                </div>
<?php
 }else{ 
    
    ?>
     <div class="loader">
        <div></div>
    </div>
      <div class="content">
    <div class="row space">
    <div class="col">
    <div class="d-flex justify-content-start">
    <span class="title-head"><img src="asset/iconbutton/icontitle.png" class="icon-head">Tài khoản</span>
    </div>
    </div>
    
  </div>
  
<div class="row">
    <div class="card-account">
    <div class="profile-card">
                <div class="avatar-card d-flex justify-content-center">
                    <img class="avatar" src="asset/icon/<?=$r_user['avatar']?>.png" width="120px">
                </div>
               <div class="info">
               <div class="nameaccount d-flex justify-content-between">
                <span>
                <div class="icon-square green flex-shrink-0 me-3">
                <i class="bi bi-tags-fill"></i>
                </div>Tên người dùng</span>
                    <span><?=$r_user['account']?></span>
                </div>
                 <div class="passaccount d-flex justify-content-between">
                    <span>
                    <div class="icon-square flex-shrink-0 me-3">
                    <i class="bi bi-envelope"></i>
                </div>Email</span>
                    <span><?=$r_user['email']?></span>
                </div>
               </div>
               
        </div>
        <div class="button">
            <button type="button" class="btn w-100 buttonlogin mb-2" data-bs-toggle="modal" href="#exampleModal" role="button">Sửa thông tin</button>
            <button type="button" class="btn w-100 btngreen" data-bs-toggle="modal" href="#deletemodel" role="button">Đăng xuất</button>
        </div>
    </div>
        
    
</div>

       
</div>
<!----SỬA THÔNG TIN--->
<?php

if(isset($_POST['savebtn'])){
    $avatar = $_POST['avatar'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE account = '$account' AND email ='$email'"));
         if($sql2 == 0){
             $sql1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE email ='$email'"));
                if($sql1 == 0){//
                     if ($password != ""){
                        if ($password == $r_user['pass']) {
                            if($email != ""){
                            $query = mysqli_query($conn, "UPDATE `user` SET `avatar`= '$avatar',`email`= '$email' WHERE `account` = '$account'");
                            
                            
                            if($query){
                                echo '<script>window.location.href="account.php";</script>';
                                
                            }else{
                              echo '<script>window.location.href="404.php";</script>';
                            }
                        }else{
                            echo '
                            <div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
                                <!-- Then put toasts within -->
                                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                    <img src="asset/Icon.png" class="rounded me-2" width="35px">
                                    <strong class="me-auto">Cảnh báo</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                    Tên đăng nhập cần lớn hơn 5 ký tự.
                                    </div>
                                </div>
                            </div>';
                        }
                        }else{
                            if($email != "" && strlen($password) > 7){
                            $password = md5($password);
                            $query = mysqli_query($conn, "UPDATE `user` SET `pass` = '$password',`avatar`= '$avatar',`email`= '$email' WHERE `account` = '$account'");
                            
                            
                            if($query){
                                echo '<script>window.location.href="account.php";</script>';
                                
                            }else{
                              echo '<script>window.location.href="404.php";</script>';
                            }
                        }else{
                            echo '
                            <div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
                                <!-- Then put toasts within -->
                                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                    <img src="asset/Icon.png" class="rounded me-2" width="35px">
                                    <strong class="me-auto">Cảnh báo</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                    Tên đăng nhập cần lớn hơn 5 ký tự.
                                    </div>
                                </div>
                            </div>';
                        }
                        }
                        }else{
                             if($email != ""){
                            $query = mysqli_query($conn, "UPDATE `user` SET `avatar`= '$avatar',`email`= '$email' WHERE `account` = '$account'");
                            $_SESSION["nameaccount"] = $username;
                            
                            if($query){
                                echo '<script>window.location.href="account.php";</script>';
                                
                                
                            }else{
                              echo '<script>window.location.href="404.php";</script>';
                            }
                        }else{
                            echo '
                            <div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
                                <!-- Then put toasts within -->
                                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                    <img src="asset/Icon.png" class="rounded me-2" width="35px">
                                    <strong class="me-auto">Cảnh báo</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                    Tên đăng nhập cần lớn hơn 5 ký tự.
                                    </div>
                                </div>
                            </div>';
                        }
                        }
                }else{//
                     echo '
                            <div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
                                <!-- Then put toasts within -->
                                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                    <img src="asset/Icon.png" class="rounded me-2" width="35px">
                                    <strong class="me-auto">Cảnh báo</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                    Email của bạn đã được sử dụng.
                                    </div>
                                </div>
                            </div>';
                }
        }else{
            
        }
             
         }

?>
<form action="account.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title green1" id="exampleModalLabel">Sửa thông tin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                            <div class="mb-3">
                            <div class="col-sm-6">
                                <label class="form-label" for="blogContactsFormFirstName">Hình đại diện</label>
                                <div class="form-check form-check-inline">
                                    <?php
                                            for ($i = 0; $i<24;$i++){
                                              echo '
                                              
                                              <input class="form-check-input" type="radio" checked="checked" name="avatar" value="'.$i.'">

                                                  <label class="form-check-label"><img src="asset/icon/'.$i.'.png" width="40px" class="rounded-circle me-2"/></label>
                                              
                                              ';
                                            }
                                            ?>

                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <span class="d-block mb-3">
                                    <label class="form-label" for="blogContactsFormComment">Tên người dùng</label>
                                    <!-- <input type="text" name="name" id="name"> -->
                                    <input type="email" class="form-control" name="username" value="<?php echo $account;?>"readonly/>
                                </span>
                                <span class="d-block mb-3">
                                    <label class="form-label" for="blogContactsFormComment">Email dự phòng</label>
                                    <!-- <input type="text" name="name" id="name"> -->
                                    <input type="text" class="form-control" name="email" value="<?=$r_user['email']?>"/>
                                </span>
                                <span class="d-block mb-3">
                                    <label class="form-label" for="blogContactsFormComment">Mật khẩu</label>
                                    <!-- <input type="text" name="name" id="name"> -->
                                    <input type="password" class="form-control" name="password">
                                </span>
                            </div>
                            
                        <div class="modal-footer">
                            <button type="submit" name="savebtn" class="btn singlebutton btn-lg red w-100 mx-0 mb-2">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
<div class="modal fade" id="deletemodel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-content1 rounded-4 shadow">
                        <div class="modal-body p-4 text-center">
                       
                            <h5 class="mb-0 ">Cảnh báo!</h5>
                            <p class="mb-0">Bạn có chắc là bạn muốn đăng xuất?</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                             <button type="button" class="btn btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" data-bs-dismiss="modal" aria-label="Close" ><strong>Huỷ</strong></button>
                            <button type="submit"  class="btn red1 btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 close " onclick="location.href='controller/controllogout.php'" >Có</button>

                        </div>
                    </div>
                </div>
            </div>
            </div>
<style>
    .card-account{
        width: 100%;
        max-width: 460px;
        margin: 1rem auto;
        display: flex;
        flex-direction: column;
        border-radius: 0.25rem;
    }
    .avatar-card{
        border-bottom: 1px solid gray;
        padding: 10px;
    }
    .info{
        padding: 10px;      
    }
    .info-use{
        border-bottom: 1px solid gray;
        padding: 10px;      
    }
    .profile-card{
        width: 100%;
        background-color: #ffff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 25px 20px -23px rgba(0, 0, 0, 0.3), 0 0 15px rgba(0, 0, 0, 0.06);
        width: 100%;
        
    }
    .nameaccount{
        margin-top: 10px;
    }
    .level{
        margin-top: 10px;
    }
    .passaccount{
        margin-top: 10px;

    }
    .avatar{
        border-radius: 100px!important;
    }
    .space{
        margin-bottom: 20px;
    }
    .icon-square {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 1.5rem;
      height: 1.5rem;
      font-size: 1rem;
      border-radius: .30rem;
      color: #ffff!important;
      background-color: #008f63;
      padding: 10px;
    }
    .btngreen{
        color: #ffff!important;
      background-color: #008f63;
      margin-bottom: 10px;
    }
    .btngreen:hover{
        color: #ffff!important;
        background-color: #027048;
    }
    
    .button{
        margin-top: 30px;
    }
    .bi {
vertical-align: -.125em;
fill: currentColor;
}


.form-check .form-check-input {
    float: none;
    margin: 5px;
}
.modal-content1 {
background-color: #fefefe;
margin: 15% auto;
/* 15% from the top and centered */
padding: 20px;
border: 1px solid #888;
width: 380px;
/* Could be more or less, depending on screen size */
}
.rounded-4 {
border-radius: .5rem;
}

.rounded-5 {
border-radius: .75rem;
}

.rounded-6 {
border-radius: 1rem;
}

.modal-sheet .modal-dialog {
width: 380px;
transition: bottom .75s ease-in-out;
}
.form-check-input:checked {
        background-color: #008f63;
        border-color: #008f63;
    }
    .form-check-input:focus {
        border-color: #b5d8c9;
        outline: 0;
        box-shadow: 0 0 0 .25rem #b5d8c9;
    }
.modal-sheet .modal-footer {
padding-bottom: 2rem;
}

.modal-alert .modal-dialog {
width: 380px;
}

.border-right {
border-right: 1px solid #eee;
}

.modal-tour .modal-dialog {
width: 380px;
}
.gap-2 {
        gap: .5rem !important;
    }
    .w-100 {
        width: 100% !important;
    }
   
     .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    .gap-3 {
        gap: 1rem !important;
    }
    .col-sm-6 {
        flex: 0 0 auto;
        width: 100%;
    }
.red1{
      color: #fb3647;
      background-color: #ffff;
    }
    .red1:hover{
      color: #c2334e;
      background-color: #ffff;
    }
   
</style>
<?php
}
include 'include/foot.php';
?>
<script>
$(window).on('load',function(){
$(".loader").fadeOut(500);
$(".content").fadeIn(500);
});
var toastLiveExample = document.getElementById('liveToast')
var toast = new bootstrap.Toast(toastLiveExample)
    toast.show()
</script>