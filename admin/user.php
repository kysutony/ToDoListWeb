<?php
include 'include/head.php';
if(empty($_COOKIE["adminpermission"])){
    echo '<script>window.location.href="../login.php";</script>';
}else{
$startRow = 0;
$pageSize = 10;
$pageNum = 1;
$offset = 10;
if (isset($_GET['pageNum']) == true) $pageNum = $_GET['pageNum'];
$startRow = ($pageNum-1)*$pageSize;
$show = mysqli_query($conn, "SELECT * FROM `user` LIMIT $startRow,$pageSize");
$from = $pageNum-$offset; if($from<1) $from =1;
$data = mysqli_query($conn,"SELECT COUNT(*) FROM `user`");
$sql =  mysqli_fetch_array($data);
$allRecord = $sql[0];
$allPage = ceil($allRecord/$pageSize);
$to = $pageNum +$offset; if ($to>$allPage) $to = $allPage;
$pageNext = $pageNum+1;
$pagePrev = $pageNum-1;
?>
<style>
.col-sm-6 {
    flex: 0 0 auto;
    width: 100%;
}

.form-check .form-check-input {
    float: none;
    margin: 5px;
}
</style>
<div class="row">
    <div class="col">
        <div class="title">
            <div class="nametitle">
                <h3><span class="name">Trang Người Dùng</span></h3>
            </div>
            <div class="distitle">
                <p>Đây là trang thống kê tất cả người dùng của trang Todolist và ứng dụng trên iOS</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col"></div>
    <div class="col-10">
        <table class="table">
            <thead>
                <tr>

                    <th scope="col" class="table-text-end">Id</th>
                    <th scope="col" class="table-text-end">Tên tài khoản</th>
                    <th scope="col" class="table-text-end">
                        <div class="d-flex justify-content-center">
                            Hình đại diện
                        </div>
                    </th>
                    <th scope="col" class="table-text-end">
                        <div class="d-flex justify-content-center">
                        Email
                        </div>
                    </th>
                    <th scope="col" class="table-text-end">
                        <div class="d-flex justify-content-center">
                            Level
                        </div>
                    </th>
                    <th scope="col" class="table-text-end">
                    <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn1 badge" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Thêm</button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                        foreach($show as $row){
                          if($row['permission'] == 0){
                            $permision = '<p>User</p>';
                            $icon = '<i class="bi bi-person-dash-fill green1"></i>';
                          }else{
                            $permision = '<p>Admin</p>';
                            $icon = '<i class="bi bi-person-plus-fill red1"></i>';
                          }
                          ?>
                <tr>

                    <td class="table-text-end">
                        <?php echo $row['id']; ?>
                    </td>
                    <td class="table-text-end">
                        <?php echo $row['account']; ?>
                    </td>
                    <td class="table-text-end">
                        <div class="d-flex justify-content-center">
                            <img src="../asset/icon/<?php echo $row['avatar']; ?>.png" width="40px"
                                class="rounded-circle me-2" />
                        </div>
                    </td>
                    <td class="table-text-end">
                        <div class="d-flex justify-content-center">
                        <?php echo $row['email']; ?>
                        </div>
                    </td>
                    <td class="table-text-end">
                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-row">
                                <span class="d-inline-flex p-2"><?php echo $icon;?></span>
                                <span class="d-inline-flex p-2"><?php echo $permision;?></span>
                            </div>
                        </div>
                    </td>
                    <td class="table-text-end">
                    <div class="d-flex justify-content-sm-evenly">
                            <button type="button" class="btn btn1 badge orange editbtn">Sửa</button>
                            <button type="button" class="btn btn1 badge red deletebtn" data-bs-toggle="modal" href="#deletemodel" role="button">Xoá</button>
                        </div>
                    </td>
                    </td>
                    <?php
                        }
                        ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
            <?php
                if($pageNum > 1){
            ?>
                    <li class="page-item">
                    <a class="page-link" href="user.php?pageNum=<?php echo $pagePrev;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    
            <?php
                }
            ?>
                    <?php for($i=$from; $i<=$to; $i++){?>
                        <?php if ($i == $pageNum) {
                            ?>
                        <li class="page-item active"><a class="page-link" href="user.php?pageNum=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php
                        }else{
                            ?>
                            <li class="page-item"><a class="page-link" href="user.php?pageNum=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php }?>
                    <?php
                    }
                    ?>
            <?php
                   if($pageNum<$allPage){
            ?>
                    <li class="page-item">
                    <a class="page-link" href="user.php?pageNum=<?php echo $pageNext;?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
            <?php
                   }
           ?>
                </ul>
        </nav>
        <!--THÊM NGƯỜI DÙNG-->
        <?php
        if(isset($_POST['adddatauser'])){
            $username = $_POST['addusername'];
            $password = $_POST['addpassword'];
            $avatar = $_POST['addavatar'];
            $level = $_POST['level'];
            $email = $_POST['addemail'];
            $password = md5($password);
            $get = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user` WHERE account='$username'"));
            if(empty($username) || empty($password) || empty($avatar)){
                echo 'Nhập đầy đủ thông tin';
                // echo '<script>alert("chua nhan");</script>';
            }else{
                if($get < 1){
                    $query = mysqli_query($conn, "INSERT INTO `user`(`account`, `avatar`, `pass`, `permission` , `email`) VALUES ('$username','$avatar','$password','$level', '$email')");
                    if($query){
                        echo '<script>window.location.href="user.php";</script>';
                        echo 'Đăng ký thành công';
                    }else{
                        echo 'Đăng ký không thành công';
                    }

                }else{
                    echo 'Tài khoản đã được đăng ký';
                }
               
            }
        }
        ?>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title green1" id="exampleModalLabel">Thêm người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="user.php" method="POST">
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label" for="blogContactsFormFirstName">Hình đại diện</label>
                                <div class="form-check form-check-inline">
                                    <?php
                                            for ($i = 0; $i<24;$i++){
                                              echo '
                                              
                                              <input class="form-check-input" type="radio" checked="checked" name="addavatar" value="'.$i.'">

                                                  <label class="form-check-label" for="'.$i.'"><img src="../asset/icon/'.$i.'.png" width="40px" class="rounded-circle me-2"/></label>
                                              
                                              ';
                                            }
                                            ?>

                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="blogContactsFormFirstName">Quyền người dùng</label>
                        <select name="level" class="form-select">
                            <option value="0" selected>User</option>
                            <option value="1">Admin</option>
                        </select>
                        </div>
                        <div class="mb-3">
                            <span class="d-block">
                                <label class="form-label" for="blogContactsFormComment">Tên người dùng</label>
                                <input name="addusername" class="form-control" placeholder="Thêm tên người dùng tại đây...">
                                
                            </span>
                        </div>
                        <div class="mb-3">
                            <span class="d-block">
                                <label class="form-label" for="blogContactsFormComment">Email</label>
                                <input type="email" class="form-control" name="addemail" placeholder="Thêm email người dùng tại đây...">
                            </span>
                        </div>
                        <div class="mb-3">
                            <span class="d-block">
                                <label class="form-label" for="blogContactsFormComment">Mật khẩu người dùng</label>
                                <input type="password" name="addpassword" class="form-control" placeholder="Thêm mật khẩu người dùng tại đây...">
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="adddatauser" class="btn btn1 btn-lg green w-100 mx-0 mb-2">Thêm</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
       
        <!--SỬA NGƯỜI DÙNG-->
        <?php
     if(isset($_POST['updatedatauser'])){
        $id = $_POST['idupdate'];
        $username = $_POST['updateaccount'];
        $password = $_POST['updatepassword'];
        $avatar = $_POST['updateavatar'];
        $level = $_POST['updatelevel'];
        $oldnameaccount = $_POST['oldnameaccount'];
        $email = $_POST['updateemail'];
        $permission = $_POST['updatepermission'];
if($oldnameaccount == $r_user['account']){
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
                Bạn không thể chỉnh sửa bản thân.
                </div>
            </div>
        </div>';
}else{
    if ($password != ""){
        if($email != "" && strlen($password) > 7){
        $password = md5($password);
        $query = mysqli_query($conn, "UPDATE `user` SET `account`='$username',`permission` = '$permission', `pass` = '$password',`avatar`= '$avatar',`email`= '$email' WHERE `id` = '$id'");
        
        
        if($query){
            echo '<script>window.location.href="user.php";</script>';
            
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
                Bạn chưa nhập email.
                </div>
            </div>
        </div>';
    }
    
    }else{
         if($email != ""){
        $query = mysqli_query($conn, "UPDATE `user` SET `account`='$username',`permission` = '$permission',`avatar`= '$avatar',`email`= '$email' WHERE `id` = '$id'");
        
        if($query){
            echo '<script>window.location.href="user.php";</script>';
            
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
                Bạn chưa nhập email.
                </div>
            </div>
        </div>';
    }
    }
}
}


        ?>
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title orange1" id="exampleModalLabel">Sửa thông tin người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="user.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="idupdate" id="idupdate">
                            <div class="mb-3">
                                <label class="form-label" for="blogContactsFormFirstName">Hình đại diện</label>
                                <div class="form-check form-check-inline">
                                    <?php
                                            for ($i = 0; $i<24;$i++){
                                              echo '
                                              
                                              <input class="form-check-input" type="radio" checked="checked"  id="updateavatar" name="updateavatar" value="'.$i.'">

                                                  <label class="form-check-label" for="'.$i.'"><img src="../asset/icon/'.$i.'.png" width="40px" class="rounded-circle me-2"/></label>
                                              
                                              ';
                                            }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="mb-3">
                                    <label class="form-label" for="blogContactsFormFirstName">Quyền người dùng</label>
                                    <select name="updatepermission" class="form-select">
                                        <option value="0" selected>User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <span class="d-block mb-3">
                                    <label class="form-label" for="blogContactsFormComment">Tên người dùng</label>
                                    <input class="form-control" name="updateaccount" id="updateaccount">
                                    <input type="hidden" class="form-control" name="oldnameaccount" id="oldnameaccount">
                                </span>
                            </div>
                            <!-- Form -->
                            <div class="mb-3">
                            <span class="d-block">
                                <label class="form-label" for="blogContactsFormComment">Email</label>
                                <input class="form-control" name="updateemail" id="updateemail">
                            </span>
                        </div>
                            <div class="mb-3">
                            <span class="d-block">
                                <label class="form-label" for="blogContactsFormComment">Mật khẩu người dùng</label>

                                <input type="password" name="updatepassword" id="updatepassword" class="form-control" placeholder="Thêm mật khẩu người dùng tại đây...">
                            </span>
                        </div>

                        </div>
                        <!-- End Form -->
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-lg orange w-100 mx-0 mb-2" name="updatedatauser">Lưu</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <!--XOÁ CÔNG VIỆC-->
        <?php
        if(isset($_POST['deletedatauser'])){
            $id = $_POST['iddelete'];
            $query = mysqli_query($conn, "DELETE FROM `user` WHERE `id` = '$id'");
            if($query){
                echo '<script>window.location.href="user.php";</script>';
                // header("location:list.php");
              }else{
                echo '<script> alert("Xoá không thành công");</script>';
              }
        }
        ?>
        <div class="modal fade" id="deletemodel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content1 rounded-4 shadow">
                    <form action="user.php" method="POST">
                    <div class="modal-body p-4 text-center">
                        <h5 class="mb-0 ">Cảnh báo!</h5>
                        <p class="mb-0">Bạn có chắc là bạn xoá người dùng này?</p>
                        <input type="hidden" name="iddelete" id="iddelete">
                    </div>
                    <div class="modal-footer flex-nowrap p-0">
                        <button type="button" class="btn btn-lg  btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" data-bs-dismiss="modal" aria-label="Close" ><strong>Huỷ</strong></button>
                            <button type="submit"  class="btn btn-lg red1 btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 close " name="deletedatauser" >Có</button>
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>

<?php
}
include 'include/foot.php';
?>
<script>
$(document).ready(function() {
    $('.editbtn').on('click', function() {

        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text().trim();
        }).get();

        console.log(data);

        $('#idupdate').val(data[0]);
        $('#updateaccount').val(data[1]);
        $('#oldnameaccount').val(data[1]);
        $('#updatelevel').val(data[4]);
        $('#updateemail').val(data[3]);

    });
});

$(document).ready(function() {
    $(document).on('click','.deletebtn', function() {

        $('#deletemodel').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text().trim();
        }).get();

        console.log(data);

        $('#iddelete').val(data[0]);
    });
});
</script>