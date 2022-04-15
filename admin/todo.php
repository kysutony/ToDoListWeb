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
$show = mysqli_query($conn, "SELECT * FROM `nhiemvu` LIMIT $startRow,$pageSize");
$from = $pageNum-$offset; if($from<1) $from =1;
$data = mysqli_query($conn,"SELECT COUNT(*) FROM `nhiemvu`");
$sql =  mysqli_fetch_array($data);
$allRecord = $sql[0];
$allPage = ceil($allRecord/$pageSize);
$to = $pageNum +$offset; if ($to>$allPage) $to = $allPage;
$pageNext = $pageNum+1;
$pagePrev = $pageNum-1;
$show1 = mysqli_query($conn, "SELECT * FROM `danhsach`");
$show2 = mysqli_query($conn, "SELECT * FROM `user`");
$page = $_SERVER['HTTP_REFERER'];
?>
<style>
    .col-sm-6 {
    flex: 0 0 auto;
}
</style>
<div class="row">
    <div class="col">
        <div class="title">
            <div class="nametitle">
                <h3><span class="name">Trang Nhiệm Vụ</span></h3>
            </div>
            <div class="distitle">
                <p>Đây là trang thống kê tất cả nhiệm vụ của trang Todolist và ứng dụng trên iOS</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col"></div>
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>

                    <th scope="col" class="table-text-end">Id</th>
                    <th scope="col" class="table-text-end">Tài khoản</th>
                    <th scope="col" class="table-text-end">Nội dung</th>
                    <th scope="col" class="table-text-end">Danh sách</th>
                    <th scope="col" class="table-text-end">
                        <div class="d-flex justify-content-center">
                            Tình trạng
                        </div>
                    </th>
                    <th scope="col" class="table-text-end">Ngày thực hiện</th>
                    <th scope="col" class="table-text-end">Ngày thêm</th>
                    <th scope="col" class="table-text-end">Ghim</th>
                    <th scope="col" class="table-text-end">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn1 badge" data-bs-toggle="modal" data-bs-target="#them">Thêm</button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    $dem = 0;
                    foreach($show as $row){
                          if($row['checklist'] == 0){
                              $icon = '
                              <i class="bi bi-circle orange1"></i>
                                ';
                          }else{
                              $icon = '
                              <i class="bi bi-check-circle-fill green1"></i>
                                                                                            ';
                          }
                          if($row['pin'] == 0){
                              $icon1 = '
                              <i class="bi bi-pin orange1"></i>
                                                            ';
                          }else{
                              $icon1 = '
                              <i class="bi bi-pin-fill green1"></i>
                                                            ';
                          }
                          
                            ?>
                <tr>

                    <td class="table-text-end">
                        <?php echo $row['id']; ?>

                    </td>
                    <td class="table-text-end">
                        <?php echo $row['idaccount'];?>

                    </td>
                    <td class="table-text-end">
                        <?php echo $row['noidung'];?>

                    </td>
                    <td class="table-text-end">
                        <?php echo $row['danhsach'];?>
                    </td>
                    </td>
                    <td class="table-text-end">
                        <div class="d-flex justify-content-center">
                            <?php echo $icon;?>
                        </div>
                    </td>
                    </td>
                    <td class="table-text-end">
                        <?php echo $row['ngayth'];?>
                    </td>
                    </td>
                    <td class="table-text-end">
                        <?php echo $row['ngaythem'];?>
                    </td>
                    </td>
                    <td class="table-text-end">
                        <?php echo $icon1;?>
                    </td>
                    <td class="table-text-end">
                        <div class="d-flex justify-content-sm-evenly">
                            <button type="button" class="btn btn1 badge orange editbtn">Sửa</button>
                            <button type="button" class="btn btn1 badge red deletebtn" data-bs-toggle="modal" href="#deletemodel" role="button">Xoá</button>
                        </div>
                    </td>
                </tr>

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
                    <a class="page-link" href="todo.php?pageNum=<?php echo $pagePrev;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    
            <?php
                }
            ?>
                    <?php for($i=$from; $i<=$to; $i++){?>
                        <?php if ($i == $pageNum) {
                            ?>
                        <li class="page-item active"><a class="page-link" href="todo.php?pageNum=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php
                        }else{
                            ?>
                            <li class="page-item"><a class="page-link" href="todo.php?pageNum=<?php echo $i?>"><?php echo $i?></a></li>
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
        <!--THÊM CÔNG VIỆC-->
        <?php
        if(isset($_POST['addtodo'])){
            $namelist = $_POST['namelist'];
            $idaccount = $_POST['idaccount'];
            $daytodo = $_POST['daytodo'];
            $nametodo = $_POST['nametodo'];
            
            $daytodo = mysqli_real_escape_string($conn,date("d-m-Y", strtotime($daytodo)));
            $dateht = date('d-m-Y');
            if(empty($namelist) || empty($idaccount) || empty($daytodo) || empty($nametodo)){
                echo 'Bạn chưa nhập đầy đủ thông tin';
            }else{
                if($daytodo >= $dateht){
                    if(isset($_POST['pintodo'])){
                        $query = mysqli_query($conn, "INSERT INTO `nhiemvu`( `idaccount`, `noidung`, `danhsach`, `checklist`, `ngayth`, `ngaythem`, `pin`) VALUES ('$idaccount','$nametodo','$namelist','0','$daytodo','$dateht','1')");
                        if($query){
                            echo 'Đã thêm nhiệm vụ quan trọng thành công';
                            echo '<script>window.location.href="todo.php";</script>';
                        }else{
                            echo 'Không thể thêm vào';
                        }
                    }else{
                        $query = mysqli_query($conn, "INSERT INTO `nhiemvu`( `idaccount`, `noidung`, `danhsach`, `checklist`, `ngayth`, `ngaythem`, `pin`) VALUES ('$idaccount','$nametodo','$namelist','0','$daytodo','$dateht','0')");
                        if($query){
                            echo 'Đã thêm thành công';
                            echo '<script>window.location.href="todo.php";</script>';
                        }else{
                            echo 'Không thể thêm vào';
                        }
                    }
                }else{
                    
                    echo 'Ngày thực hiện nhỏ hơn ngày hiện tại';
                }
                
            }
        }
        
        ?>
         <!-- Form -->
        <form action="todo.php" method="POST">
            <div class="modal fade" id="them" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title green1" id="exampleModalLabel">Thêm công việc</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 mb-4 mb-sm-0">
                                   
                                    <div class="mb-4">
                                        <label class="form-label" for="contactsFormLasttName">Người thực hiện</label>
                                        <select name="idaccount" id="idaccount" class="form-select" aria-label="Default select example">

                                            <?php 
                                        foreach($show2 as $row){
                                            ?>
                                            <option value="<?php echo $row['account'];?>" selected>
                                                <?php echo $row['account'];?></option>
                                            <?php
                                        }
                                        ?>

                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="mb-4">
                                        <label class="form-label" for="contactsFormLasttName">Danh sách</label>
                                        <select name="namelist" id="namelist" class="form-select" aria-label="Default select example">

                                            <?php 
                                        foreach($show1 as $row){
                                        ?>
                                            <option value="<?php echo $row['tendanhsach'];?>" selected>
                                                <?php echo $row['tendanhsach'];?></option>
                                            <?php
                                        }
                                        ?>

                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-4 mb-sm-0">

                                    <div class="mb-4">
                                        <div class="form-check form-switch ">
                                            <label class="form-label" for="blogContactsFormFirstName">Ghim công việc</label>
                                            <input class="form-check-input" type="checkbox" name="pintodo">


                                        </div>
                                    </div>
                                    
                                </div>
                               
                                <div class="col-sm-6">

                                    <div class="mb-4">
                                        <label class="form-label" for="blogContactsFormLasttName">Ngày thực hiện</label>
                                        <input class="form-control" type="date" name="daytodo" id="daytodo">
                                    </div>

                                </div>

                            </div>
                            
                            <span class="d-block mb-3">
                                <label class="form-label" for="blogContactsFormComment">Tên công việc</label>
                                
                                <textarea class="form-control" name="nametodo" id="nametodo" rows="3"></textarea>
                            </span>
                            
                        </div>
                        <div class="modal-footer">

                            <button type="submit" name="addtodo"
                                class="btn btn1 btn-lg green w-100 mx-0 mb-2">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- End Form -->
        <!--SỬA CÔNG VIỆC-->
        <?php
        if(isset($_POST['updatetodo'])){
            $id = $_POST['idupdate'];
            $idaccount = $_POST['idaccountupdate'];
            $namelistupdate = $_POST['namelistupdate'];
            $daytodo = $_POST['daytodoupdate'];
            $nametodoupdate = $_POST['todoupdate'];
            $dateht = date('d-m-Y');
            $time = time();
            $daytodo = mysqli_real_escape_string($conn,date("d-m-Y", strtotime($daytodo)));
            
            if(empty($namelistupdate) || empty($idaccount) || empty($daytodo) || empty($nametodoupdate)){
                echo 'Bạn chưa nhập đầy đủ thông tin';
            }else{

                    if(isset($_POST['doneupdate'])){
                        $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `idaccount`='$idaccount',`noidung`='$nametodoupdate',`danhsach`='$namelistupdate',`checklist`='1',`ngayth`='$daytodo',`ngaythem`='$time',`pin`='0' WHERE `id` = '$id'");
                        if($query){
                            echo 'Đã cập nhật nhiệm vụ hoàn thành công việc';
                            echo '<script>window.location.href="'.$page.'";</script>';
                        }else{
                            echo 'Không thể thêm vào';
                        }
                    }elseif(isset($_POST['pintodoupdate'])){
                        $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `idaccount`='$idaccount',`noidung`='$nametodoupdate',`danhsach`='$namelistupdate',`checklist`='0',`ngayth`='$daytodo',`ngaythem`='$time',`pin`='1' WHERE `id` = '$id'");
                        if($query){
                            echo 'Đã cập nhật nhiệm vụ quan trọng thành công';
                            echo '<script>window.location.href="'.$page.'";</script>';
                        }else{
                            echo 'Không thể thêm vào';
                        }
                    }elseif(isset($_POST['pintodoupdate']) || isset($_POST['doneupdate'])){
                        $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `idaccount`='$idaccount',`noidung`='$nametodoupdate',`danhsach`='$namelistupdate',`checklist`='1',`ngayth`='$daytodo',`ngaythem`='$time',`pin`='1' WHERE `id` = '$id'");
                        if($query){
                            echo 'Đã cập nhật nhiệm vụ quan trọng thành công và hoàn thành công việc';
                            echo '<script>window.location.href="'.$page.'";</script>';
                        }else{
                            echo 'Không thể thêm vào';
                        }
                    }else{
                        $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `idaccount`='$idaccount',`noidung`='$nametodoupdate',`danhsach`='$namelistupdate',`checklist`='0',`ngayth`='$daytodo',`ngaythem`='$time',`pin`='0' WHERE `id` = '$id'");
                        if($query){
                            echo 'Đã cập nhật thành công';
                            echo '<script>window.location.href="'.$page.'";</script>';
                        }else{
                            echo 'Không thể thêm vào';
                        }
                    }
               
            }
        }
        ?>
         <!-- Form -->
        <form action="todo.php" method="POST">
            <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title orange1" id="exampleModalLabel">Sửa công việc</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="idupdate" id="idupdate">
                                <div class="col-sm-6 mb-4 mb-sm-0">

                                    <div class="mb-4">
                                        <label class="form-label" for="contactsFormLasttName">Người thực hiện</label>
                                        <input class="form-control disabled" type="text" id="idaccountupdate" name="idaccountupdate" readonly/>
                                    </div>
                             
                                </div>
                               
                                <div class="col-sm-6">
                                    
                                    <div class="mb-4">
                                        <label class="form-label" for="contactsFormLasttName">Danh sách</label>
                                        <input class="form-control disabled" type="text" id="listname" name="namelistupdate" readonly/>
                                    </div>
                                    
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-4 mb-sm-0">
                                   
                                        <div class="form-check form-switch ">
                                            <label class="form-label" for="blogContactsFormFirstName">Ghim công việc</label>
                                            <input class="form-check-input" type="checkbox" name="pintodoupdate">
                                        </div>
                                        <div class="form-check form-switch ">
                                        <label class="form-label" for="blogContactsFormFirstName">Hoàn thành công việc</label>
                                            <input class="form-check-input" type="checkbox" role="switch" name="doneupdate" id="doneupdate">
                                        </div>
                                    
                                </div>
                               
                                <div class="col-sm-6">
                                   
                                    <div class="mb-4">
                                        <label class="form-label" for="blogContactsFormLasttName">Ngày thực hiện</label>
                                        <input class="form-control" type="text" name="daytodoupdate" id="daytodoupdate" onfocus="(this.type='date')" onblur="(this.type='text')"/>
                                    </div>
                                   
                                </div>
                                
                            </div>
                            
                            <span class="d-block mb-3">
                                <label class="form-label" for="blogContactsFormComment">Tên công việc</label>
                                <textarea class="form-control" type="text" name="todoupdate" id="todoupdate" rows="3"></textarea>
                            </span>

                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-lg orange w-100 mx-0 mb-2" name="updatetodo">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Form -->
        <!--XOÁ CÔNG VIỆC-->
        <?php
            if(isset($_POST['deletetodo'])){
                $id = $_POST['iddelete'];
                $query = mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `id` = '$id'");
                if($query){
                    echo '<script>window.location.href="'.$page.'";</script>';
                }else{
                  echo '<script> alert("Xoá không thành công");</script>';
                }
              }
            ?>
             <!-- Form -->
        <form action="todo.php" method="POST">
            <div class="modal fade" id="deletemodel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-content1 rounded-4 shadow">
                        <div class="modal-body p-4 text-center">
                        <input type="hidden" name="iddelete" id="iddelete">
                            <h5 class="mb-0 ">Cảnh báo!</h5>
                            <p class="mb-0">Bạn có chắc là bạn xoá công việc này?</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <button type="button" class="btn btn-lg  btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" data-bs-dismiss="modal" aria-label="Close" ><strong>Huỷ</strong></button>
                            <button type="submit"  class="btn btn-lg red1 btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 close " name="deletetodo" >Có</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
       <!-- End Form -->
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
        $('#idaccountupdate').val(data[1]);
        $('#todoupdate').val(data[2]);
        $('#listname').val(data[3]);
        $('#daytodoupdate').val(data[5]);
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
