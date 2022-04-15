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
.space{
  margin-bottom: 10px;
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
    <main class="form-signin">
      <!-- <form action="signup.php" method="POST"> -->
        <img class="mb-4" src="asset/image/b.png" width="200px">
        <h1 class="h3 mb-3 fw-normal">Hãy đăng ký</h1>
        <div class="checkbox mb-3">
          <label>
            <p>Nếu đã có tài khoản hãy <a href="login.php" style="color: #008f63; text-decoration: none;">đăng nhập</a></p>
          </label>
        </div>
        <div class="form-floating">
          <input name="username" type="text" class="form-control" id="username" placeholder="name@example.com">
          <label for="floatingInput">Tên đăng nhập</label>
        </div>
        <div class="form-floating space">
          <input name="email" type="email" class="form-control" id="email" placeholder="Email">
          <label for="floatingPassword">Email dự phòng</label>
        </div>
        <div class="form-floating form-floating1">
          <input name="password" type="password" class="form-control form-control1"  placeholder="Password" id="password" >
          <i class="bi bi-eye-slash" id="togglePassword"></i>
          <label for="floatingPassword">Mật khẩu</label>
        </div>
        <div class="form-floating form-floating1">
          <input name="repassword" type="password" class="form-control form-control1"  placeholder="Repassword" id="repassword" >
          <i class="bi bi-eye-slash" id="toggleRePassword"></i>
          <label for="floatingPassword">Xác nhận lại mật khẩu</label>
        </div>
        
        
       
        <button name="dangky" class="w-100 btn button-login" id = "signup" type="button">Đăng ký</button>
      <!-- </form> -->
      <div id="myModal" class="modal"> 
              <div class="modal-content rounded-4 shadow">
                <div class="modal-body p-4 text-center">
                  <h5 class="mb-0">Thông báo!</h5>
                  <p class="mb-0" id="result">Đăng nhập thành công</p>
                </div>
                <div class="modal-footer flex-nowrap p-0 ">
                <!-- <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" onclick="location.href='login.php'" data-bs-dismiss="modal">Có, tôi muốn</button> -->
                <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 w-100 mx-0 close"><strong>Đóng</strong></button>
                  
          </div>
            </div>
          </div>
    </main>
</div>
<style>
            .modal {
  display: none; 
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 380px; /* Could be more or less, depending on screen size */
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

.rounded-4 { border-radius: .5rem; }
.rounded-5 { border-radius: .75rem; }
.rounded-6 { border-radius: 1rem; }

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

.border-right { border-right: 1px solid #eee; }

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

$('#signup').click(function(){
  var username = $('#username').val();
  var password = $('#password').val();
  var repassword = $('#repassword').val();
  var email = $('#email').val();
  // if(username != '' ||  password != ''){
  //   console.log("trong")
  // }
  console.log(username);
  console.log(password);
  console.log(repassword);
  console.log(email);
  $.post("https://2dolist.website/controller/controlsignup.php",
    {
      username: username,
      password: password,
      repassword: repassword,
      email: email
    },
    function(data,status){
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
const toggleRePassword = document.querySelector('#toggleRePassword');
const repassword = document.querySelector('#repassword');
toggleRePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
    repassword.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});
</script>