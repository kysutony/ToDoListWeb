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
$show = mysqli_query($conn, "SELECT * FROM `danhsach` LIMIT $startRow,$pageSize");
$from = $pageNum-$offset; if($from<1) $from =1;
$data = mysqli_query($conn,"SELECT COUNT(*) FROM `danhsach`");
$sql =  mysqli_fetch_array($data);
$allRecord = $sql[0];
$allPage = ceil($allRecord/$pageSize);
$to = $pageNum +$offset; if ($to>$allPage) $to = $allPage;
$pageNext = $pageNum+1;
$pagePrev = $pageNum-1;

$show1 = mysqli_query($conn, "SELECT * FROM `user`");
$icon = array("eye" ,"book","person","lightbulb", "pencil", "folder", "paperclip", "link" ,"moon", "cloud" ,"heart" ,"star", "flag" ,"tag" ,"camera" ,"bookmark", "gear", "command", "sunrise", "tornado","phone","envelope", "bag", "cart","hammer", "house", "clock", "alarm");
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
                <h3><span class="name">Trang Danh Sách</span></h3>
            </div>
            <div class="distitle">
                <p>Đây là trang thống kê tất cả danh sách của trang Todolist và ứng dụng trên iOS</p>
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
                    <th scope="col" class="table-text-end">Tài khoản</th>
                    <th scope="col" class="table-text-end">Tên danh sách</th>
                    <th scope="col" class="table-text-end">Icon</th>
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
                           ?>
                <tr>
                    <td class="table-text-end">

                        <?php echo $row['id']; ?>

                    </td>
                    <td class="table-text-end">

                        <?php echo $row['idaccount']; ?>

                    </td>
                    <td class="table-text-end">

                        <?php echo $row['tendanhsach']; ?>

                    </td>
                    
                    <td class="table-text-end">

                    <i class="bi bi-<?php echo $row['icon']; ?> green1"></i>

                    </td>
                    <td class="table-text-end">

                        <div class="d-flex justify-content-sm-evenly">
                            <button type="button" class="btn btn1 badge orange editbtn">Sửa</button>
                            <button type="button" class="btn btn1 badge red deletebtn">Xoá</button>
                        </div>

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
            <?php
                if($pageNum > 1){
            ?>
                    <li class="page-item">
                    <a class="page-link" href="list.php?pageNum=<?php echo $pagePrev;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    
            <?php
                }
            ?>
                    <?php for($i=$from; $i<=$to; $i++){?>
                        <?php if ($i == $pageNum) {
                            ?>
                        <li class="page-item active"><a class="page-link" href="list.php?pageNum=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php
                        }else{
                            ?>
                            <li class="page-item"><a class="page-link" href="list.php?pageNum=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php }?>
                    <?php
                    }
                    ?>
            <?php
                   if($pageNum<$allPage){
            ?>
                    <li class="page-item">
                    <a class="page-link" href="todo.php?pageNum=<?php echo $pageNext;?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
            <?php
                   }
           ?>
                </ul>
        </nav>
<!--THÊM DANH SÁCH-->
        <?php
        if(isset($_POST['adddata'])){
          $name = $_POST['addidaccount'];
          $namelist = $_POST['themtendanhsach'];
          $icon = $_POST['iconadd'];
          $query = mysqli_query($conn, "INSERT INTO `danhsach`(`idaccount`, `tendanhsach`, `icon`) VALUES ('$name','$namelist','$icon')");
          if($query){
              echo '<script>window.location.href="list.php";</script>';
              
          }else{
              echo '<script> alert("Cập nhật không thành công");</script>';
          }
      }       
      ?>
        <form action="list.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title green1" id="exampleModalLabel">Thêm danh sách</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="blogContactsFormLasttName">Icon</label>
                                    <div class="form-check form-check-inline">
                                        <?php
                                    $arrlength = count($icon);
                                    for($x = 0; $x < $arrlength; $x++) {
                                      echo '
                                      
                                      <input class="form-check-input" type="radio" checked="checked" id="iconadd" name="iconadd" value="'.$icon[$x].'">

                                          <label class="form-check-label" for="'.$icon[$x].'"><i class="bi bi-'.$icon[$x].' green1"></i></label>
                                       
                                      ';
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form -->
                            
                            <!-- Form -->
                            <div class="mb-3">
                                <span class="d-block">
                                    <label class="form-label" for="blogContactsFormComment">Tên danh sách</label>
                                    <input class="form-control" name="themtendanhsach" id="themtendanhsach" placeholder="Thêm nội dung tại đây...">
                                    <!-- <textarea class="form-control" name="addidaccount" id="addidaccount" placeholder="Thêm nội dung tại đây..." aria-label="Thêm nội dung tại đây..." rows="1"></textarea> -->
                                </span>
                            </div>
                        </div>
                        <div class="row">
                                <span class="d-block mb-3">
                                    <label class="form-label" for="blogContactsFormComment">Tên người dùng</label>
                                    <!-- <input type="text" name="name" id="name"> -->
                                    <select name="addidaccount" class="form-select" aria-label="Default select example">
                                        
                                        <?php 
                                        foreach($show1 as $row){
                                            ?>
                                            <option value="<?php echo $row['account'];?>" selected><?php echo $row['account'];?></option>
                                        <?php
                                        }
                                        ?>
                                        
                                    </select>
                                    <!-- <textarea class="form-control" name="themtendanhsach" id="themtendanhsach" placeholder="Thêm tên tại đây..." aria-label="Thêm tên tại đây..." rows="1"></textarea> -->
                                </span>
                            </div>
                        <div class="modal-footer">
                            <button type="submit" name="adddata" class="btn btn-lg green w-100 mx-0 mb-2">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!--SỬA DANH SÁCH-->
        <?php
        if(isset($_POST['updatedata'])){
          $id = $_POST['id'];
          $name = $_POST['idaccount'];
          $namelist = $_POST['tendanhsach'];
          $icon = $_POST['icon'];
          $query = mysqli_query($conn, "UPDATE `danhsach` SET `idaccount`='$name',`tendanhsach`='$namelist',`icon`='$icon' WHERE `id` = '$id'");
          if($query){
              echo '<script>window.location.href="list.php";</script>';
              // header("location:list.php");
          }else{
              echo '<script> alert("Cập nhật không thành công");</script>';
          }
      }       
      ?>
              
        <form action="list.php" method="POST">
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title orange1" id="exampleModalLabel">Sửa danh sách</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3">
                                <label class="form-label" for="blogContactsFormFirstName">Icon danh sách</label>
                                <div class="form-check form-check-inline">
                                    <?php
                                    $arrlength = count($icon);
                                    for($x = 0; $x < $arrlength; $x++) {
                                      echo '
                                      
                                      <input class="form-check-input" type="radio" checked="checked" id="icon" name="icon" value="'.$icon[$x].'">

                                          <label class="form-check-label" for="'.$icon[$x].'"><i class="bi bi-'.$icon[$x].' green1"></i></label>
                                       
                                      ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <span class="d-block mb-3">
                                    <label class="form-label" for="blogContactsFormComment">Tên danh sách</label>
                                    <!-- <input type="text" name="name" id="name"> -->
                                    <input type="text" class="form-control" name="tendanhsach" id="tendanhsach" >
                                </span>
                            </div>
                            <div class="row">
                                <span class="d-block mb-3">
                                    <label class="form-label" for="blogContactsFormComment">Tên người dùng</label>
                                    <!-- <input type="text" name="name" id="name"> -->
                                    <!-- <input type="text" class="form-control" name="tendanhsach" id="tendanhsach"> -->
                                    <select name="idaccount" id="idaccount" class="form-select" aria-label="Default select example">
                                        
                                        <?php 
                                        foreach($show1 as $row){
                                            ?>
                                            <option  value="<?php echo $row['account'];?>" selected><?php echo $row['account'];?></option>
                                        <?php
                                        }
                                        ?>
                                        
                                    </select>
                                </span>
                            </div>
                            <!-- Form -->
                        </div>
                        <!-- End Form -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg orange w-100 mx-0 mb-2" name="updatedata">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!--XOÁ DANH SÁCH-->
        <?php
            if(isset($_POST['deletedata'])){
                $id = $_POST['iddelete'];
                $query = mysqli_query($conn, "DELETE FROM `danhsach` WHERE `id` = '$id'");
                if($query){
                  echo '<script>window.location.href="list.php";</script>';
                  // header("location:list.php");
                }else{
                  echo '<script> alert("Cập nhật không thành công");</script>';
                }
              }
            ?>
        <div class="modal fade" id="deletemodel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content1 rounded-4 shadow">
                <form action="list.php" method="POST">
                    <div class="modal-body p-4 text-center">
                    <input type="hidden" name="iddelete" id="iddelete">
                        <h5 class="mb-0 ">Cảnh báo!</h5>
                        <p class="mb-0">Bạn có chắc là bạn xoá danh sách này?</p>
                    </div>
                    <div class="modal-footer flex-nowrap p-0">
                         <button type="button" class="btn btn-lg  btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" data-bs-dismiss="modal" aria-label="Close" ><strong>Huỷ</strong></button>
                            <button type="submit"  class="btn btn-lg red1 btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 close " name="deletedata" >Có</button>
                       
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

        $('#id').val(data[0]);
        $('#idaccount').val(data[1]);
        $('#tendanhsach').val(data[2]);
        $('#icon').val(data[3]);
    });
});

</script>
<script>
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