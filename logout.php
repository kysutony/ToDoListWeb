<?php
include 'include/head.php';

$sql = 'SELECT * FROM `nhiemvu`';
$result = mysqli_query($conn, $sql);

//đăng xuất
        if (isset($_POST['okout'])){
            unset($_SESSION['user']);
            echo '<div class="list3">Đăng xuất thành công ,nhấn <a href="/" style="color:;">vào đây</a> để về Trang Chủ  !</div>';
            $suc = 'ok';
        }if (isset($_POST['noout'])){
            echo '<script>window.location.href="index.php";</script>';
        }if ($suc == 'ok'){
            echo '<script>window.location.href="index.php";</script>';
        }
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
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>
  <div class="text-center">
      <div class="form-signin">
        <form action="logout.php" method="POST">
          <img class="mb-4" src="asset/Logo.png" width="100px">
          <h1 class="h3 mb-3 fw-normal">Bạn có muốn đăng xuất</h1>
          <div class="form-floating">
          <input type="submit" name="okout" class="btn singlebutton" value="Có" >
          <input type="submit" name="noout" class="btn singlebutton" value="Không">
          </div>
        </form>
      </div>
  </div>
</div>
<?php
include 'include/foot.php';
?>
   