<?php
include 'include/head.php';
?>
<style>
body {
    height: 100%;
}

body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f0f0f0;
}

.form-signin {
  width: 100%;
  max-width: 400px;
  padding: 15px;
  margin: auto;
  padding-bottom: 100px;
  text-align: center;
}
.form-signin .checkbox {
    font-weight: 400;
}

.form-signin .form-floating:focus-within {
    z-index: 2;
}
.form-floating1{
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  margin-bottom: 10px!important;
}
.form-signin input[type="text"] {
  margin-bottom: 10px;
  
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
 
}
.form-check{
margin-top: 20px;
margin-bottom: 20px;
text-align: right;    
}
.checkbox{
    
    text-align: left!important;
}
.mb-3{
    margin-top: 1rem;
}
p {
    margin-top: 0;
    margin-bottom: 0rem;
}
a{
    color: #008f63;
    text-decoration: none!important;
}
a:hover{
    color: #008f63;
    text-decoration: none!important;
}
form i {
    margin-left: -30px;
    cursor: pointer;
}
.form-control1{
  display: inline-block;
  width: 93%;
  background-color: #fff;
  border: 0px;
  margin-bottom: 0px!important;

}
</style>
<div class="container">
    <!-- <div id="result"></div> -->
    <div class="form-signin">
        <!-- <form action="login.php" method="POST"> -->
        <img class="mb-4" src="asset/image/done-5.png" width="200px">
        <h1 class="h3 mb-3 fw-normal">Hãy đăng nhập</h1>
        <div class="checkbox mb-3">
            <label>
                <p>Nếu chưa đăng ký hãy <a href="signup.php" >đăng
                        ký</a></p>
            </label>
        </div>
        <div class="form-floating">
            <input name="username" type="text" class="form-control" id="username" placeholder="name@example.com">
            <label for="floatingInput">Tên đăng nhập</label>
        </div>
        <div class="form-floating form-floating1">
          <input name="password" type="password" class="form-control form-control1"  placeholder="Password" id="password" >
          <i class="bi bi-eye-slash" id="togglePassword"></i>
          <label for="floatingPassword">Mật khẩu</label>
        </div>
        <div class="form-check">
                
                <a href="forgetpassword.php">Quên mật khẩu</a>
        </div>
        
        
        <button name="dangnhap" class="w-100 btn button-login" id="login" type="button">Đăng nhập</button>
        <!-- </form> -->
    </div>
</div>
</div>
<div id="myModal" class="modal">
    <div class="modal-content rounded-4 shadow">
        <div class="modal-body p-4 text-center">
            <h5 class="mb-0">Thông báo!</h5>
            <p class="mb-0" id="result">Đăng nhập thành công</p>
        </div>
        <div class="modal-footer flex-nowrap p-0 ">
            <button type="button"
                class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 w-100 mx-0 close"><strong>Đóng</strong></button>

        </div>
    </div>
</div>

<style>
.modal {
    display: none;
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 380px;
    /* Could be more or less, depending on screen size */
}

/* The Close Button */
/* .close {
  
} */

/* .close:hover, */
/* .close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
} */
.b-example-divider {
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.bi {
    vertical-align: -.125em;
    fill: currentColor;
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
</style>

<?php
include 'include/foot.php';
?>
<script>
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal.style.display = "none";
}

$('#login').click(function() {
    var username = $('#username').val();
    var password = $('#password').val();
    // if(username != '' ||  password != ''){
    //   console.log("trong")
    // }
    console.log(username);
    console.log(password);
    $.post("https://2dolist.website/controller/controllogin.php", {
            username: username,
            password: password
        },
        function(data, status) {
            $('#result').html(data);
            modal.style.display = "block";
            // alert("Data: " + data + "\nStatus: " + status);
        });
})
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});
</script>