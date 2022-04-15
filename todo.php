<?php
include 'include/head.php';
// BẮT BIẾN ĐÃ TRUYỀN QUA
$idlist = trim(htmlspecialchars(stripslashes(addslashes($_GET['idlist']))));
$list = trim(htmlspecialchars(stripslashes(addslashes($_GET['list']))));
$icon = trim(htmlspecialchars(stripslashes(addslashes($_GET['icon']))));

// TRUY VẤN DANH SÁCH
$show = mysqli_query($conn,"SELECT * FROM `nhiemvu` WHERE `id_list` ='$idlist' AND `danhsach` = '$list' AND `idaccount` = '$account' AND `checklist` = 0");
$show2 = mysqli_num_rows($show);
//LẤY LINK HIỆN TẠI
// $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
// $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//NÚT XOÁ DANH SÁCH
if(isset($_POST['deletelistbtn'])){
  $namelist = $_POST['namelist'];
  $query = mysqli_query($conn, "DELETE FROM `danhsach` WHERE `idaccount` = '$account' AND `tendanhsach` = '$namelist'");
  $query2 = mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `idaccount` = '$account' AND `danhsach` = '$namelist'");
  if($query){
    echo '<script>window.location.href="list.php";</script>';
    }else{
        echo 'Không thể thêm vào';
    }
}
if(isset($_POST['updatelist'])){
  $updatenamelist = $_POST['updatenamelist'];
  $updateicon = $_POST['updateicon'];
  $query2 = mysqli_query($conn, "UPDATE `nhiemvu` SET `danhsach`='$updatenamelist' WHERE `idaccount` = '$account' AND `danhsach` = '$list'");
  $query = mysqli_query($conn, "UPDATE `danhsach` SET `tendanhsach`='$updatenamelist',`icon`='$updateicon' WHERE `idaccount` = '$account' AND `tendanhsach` = '$list'");
  
  if($query){
    echo 'Đã thêm nhiệm vụ quan trọng thành công';
    echo '<script>window.location.href="list.php";</script>';
    }else{
        echo 'Không thể thêm vào';
    }
}
$iconArray = array("eye" ,"book","person","lightbulb", "pencil", "folder", "paperclip", "link" ,"moon", "cloud" ,"heart" ,"star", "flag" ,"tag" ,"camera" ,"bookmark", "gear", "command", "sunrise", "tornado","phone","envelope", "bag", "cart","hammer", "house", "clock", "alarm");
?>

<?php
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
      <?php }else{ ?>
 <div class="loader">
        <div></div>
    </div>
<div class="container" style="margin-top: 50px;">
    
    <div class="content">
<div class="row">
  
    <div class="col d-flex justify-content-start">
    <div class="d-flex align-items-center">
    <?php
    //KIỂM TRA CÓ 2 BIẾN ĐC TRUYỀN QUA Ko NẾU KO CÓ SẼ KO HIỆN GÌ CẢ
    if($list == "" && $icon == ""){
      echo '';
    }else{
      $link = "window.location.href='list.php';";
      echo '
      <button class="btn btn-lg" onclick="'.$link.'"><i class="bi bi-chevron-left icon-lg"></i></button>
    <i class="bi bi-'.$icon.' icon-square"></i>
    <h2 style="color:#008f63">'.$list.'</h2>
    <div class="dropdown-title">
                    <span data-bs-toggle="tooltip" title="Tuỳ chọn">
                    <button class="btn btn-lg"><i class="bi bi-three-dots icon-lg"></i></button>
                    </span>
                    <div class="btn-group-vertical">
                      <!--XOÁ DANH SÁCH--->
                      <button type="button" class="btn d-flex gap-3 btn-green" data-bs-toggle="modal" href="#editmodellist" role="button"><i class="bi bi-pencil-square"></i>Chỉnh Sửa</button>
                    <button type="button" class="btn d-flex gap-3 btn-title" data-bs-toggle="modal" href="#deletemodellist" role="button"><i class="bi bi-trash"></i>Xoá</button>
                    </div>
                  </div>
      ';
    }
    ?>
    <!---FORM CHỈNH SỬA DANH SÁCH--->
    <form action="<?php echo $url;?>" method="POST">
    <div class="modal fade" id="editmodellist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title green1" id="exampleModalLabel">Sửa danh sách</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                
                                    <label class="form-label" for="blogContactsFormLasttName">Icon</label>
                                    <div class="form-check form-check-inline">
                                        <?php
                                    $arrlength = count($iconArray);
                                    for($x = 0; $x < $arrlength; $x++) {
                                      echo '
                                      
                                      <input class="form-check-input" type="radio" checked="checked" name="updateicon" value="'.$iconArray[$x].'">

                                          <label class="form-check-label" for="'.$iconArray[$x].'"><i class="bi bi-'.$iconArray[$x].' green1"></i></label>
                                       
                                      ';
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            <!-- End Form -->
                            
                            <!-- Form -->
                            <div class="mb-3">
                                <span class="d-block">
                                    <label class="form-label" for="blogContactsFormComment">Tên danh sách</label>
                                    <input class="form-control" name="updatenamelist" placeholder="Thêm nội dung tại đây..." value="<?php echo $list;?>">
                                    <!-- <textarea class="form-control" name="addidaccount" id="addidaccount" placeholder="Thêm nội dung tại đây..." aria-label="Thêm nội dung tại đây..." rows="1"></textarea> -->
                                </span>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" name="updatelist" class="btn red w-100 mx-0 mb-2">Sửa</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </form>
    <!---FORM CỦA NÚT XOÁ DANH SÁCH--->
                  <form action="<?php echo $url;?>" method="POST">
                  <div class="modal fade" id="deletemodellist" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content modal-content1 rounded-4 shadow">
                                  <div class="modal-body p-4 text-center">
                                    <input type="hidden" name="namelist" value="<?php echo $list;?>">
                                      <h4 class="mb-0 ">Cảnh báo!</h4>
                                      <h6 class="mb-0">Khi xoá danh sách sẽ xoá tất cả việc!</h6>
                                      <h6 class="mb-0">Bạn có muốn xoá?</h6>
                                  </div>
                                  <div class="modal-footer flex-nowrap p-0">
                                   <button type="button" class="btn btn-lg  btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" data-bs-dismiss="modal" aria-label="Close" ><strong>Huỷ</strong></button>
                            <button type="submit"  class="btn red1 btn-lg  btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 close "name="deletelistbtn"  >Có</button>
                                     
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
    </div>
    </div>
     <!---NÚT THÊM CÔNG VIỆC-->
     <div class="col d-none d-sm-block d-sm-none d-md-block"></div>
    <div class="col d-flex justify-content-center">
      <div class="d-flex align-items-center">
      <?php
      if($list == "" && $icon == ""){
        echo '';
      }else{
        echo '<span data-bs-toggle="modal" data-bs-target="#them">
        <button  type="button" class="btn d-flex gap-3 button-head text-nowrap"  data-bs-toggle="tooltip" title="Thêm công việc"><i class="bi bi-plus-circle-fill"></i> Thêm công việc</button>
        </span>';
      }
      ?>
      </div>
    </div>
   
<?php
if(isset($_POST['addtodo'])){
  $id_list = $idlist;
  $idaccount = $account;
  $daytodo = $_POST['daytodo'];
  $nametodo = $_POST['nametodo'];
  $namelist = $_POST['namelist'];
  $daytodo = mysqli_real_escape_string($conn,date("d-m-Y", strtotime($daytodo)));
  $dateht = date('d-m-Y');
  if(empty($idaccount) || empty($daytodo) || empty($namelist)|| empty($nametodo)){
    echo 'Bạn chưa nhập đầy đủ thông tin';
}else{
      if($daytodo >= $dateht){
          if(isset($_POST['pintodo'])){
              $query = mysqli_query($conn, "INSERT INTO `nhiemvu`(`id_list`,`idaccount`, `noidung`,`danhsach`, `checklist`, `ngayth`, `ngaythem`, `pin`) VALUES ('$id_list','$idaccount','$nametodo','$namelist','0','$daytodo','$dateht','1')");
              if($query){
                  echo '<script>window.location.href="'.$url.'";</script>';
              }else{
                  echo 'Không thể thêm vào';
              }
          }else{
              $query = mysqli_query($conn, "INSERT INTO `nhiemvu`(`id_list`,`idaccount`, `noidung`,`danhsach`, `checklist`, `ngayth`, `ngaythem`, `pin`) VALUES ('$id_list','$idaccount','$nametodo','$namelist','0','$daytodo','$dateht','0')");
              if($query){
                  echo 'Đã thêm thành công';
                  echo '<script>window.location.href="'.$url.'";</script>';
              }else{
                  echo 'Không thể thêm vào';
              }
          }
      }else{
          
          echo ' <div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
            <!-- Then put toasts within -->
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <img src="asset/Icon.png" class="rounded me-2" width="35px">
                <strong class="me-auto">Thêm việc thất bại!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                Ngày thực hiện nhỏ hơn ngày hiện tại.
                </div>
            </div>
        </div>';
      }
      }
  
}
?>
 <!-- Form -->
        <form action="<?php echo $url;?>" method="POST">
            <div class="modal fade" id="them" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title green-title" id="exampleModalLabel">Thêm công việc</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                    <div class="mb-4">
                                        <label class="form-label" for="contactsFormLasttName">Danh sách</label>
                                        <input class="form-control" type="text" name="namelist"  value="<?php echo $list;?>" readonly/>
                                    </div>
                                
                                <div class="col-sm-10">
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
                            <button type="submit" name="addtodo" class="btn btn1 btn-lg orange w-100 mx-0 mb-2">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
               <!-- End Form -->
  </div>

    <div class="row justify-content-center">
    <div class="list-group">
            <?php
            // HOÀN THÀNH NHIỆM VỤ

            if(isset($_POST['finishbtn'])){
              $id = $_POST['idtodo'];
              $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `checklist`= 1 WHERE `idaccount` = '$account' AND `id` = '$id'");
              if($query){
                echo '<script>window.location.href="'.$url.'";</script>';
              }else{
                echo '<script>window.location.href="404.php";</script>';
              }
            }
            //GHIM HOẶC BỎ GHIM
            if(isset($_POST['unpinbtn'])){
              $id = $_POST['idtodo'];
                  $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `pin` = 0 WHERE `idaccount` = '$account' AND `id` = '$id'");

                  if($query){
                    echo '<script>window.location.href="'.$url.'";</script>';
                    echo '<script>$(window).on("load",function(){
$(".loader").fadeOut(1000);
$(".content").fadeIn(1000);
});</script>';
                  }else{
                      echo '<script>window.location.href="404.php";</script>';
                  }
          }elseif(isset($_POST['pinbtn'])){
            $id = $_POST['idtodo'];
            $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `pin`= 1 WHERE `idaccount` = '$account' AND `id` = '$id'");

            if($query){
              echo '<script>window.location.href="'.$url.'";</script>';
            }else{
                echo '<script>window.location.href="404.php";</script>';
            }
          }
            //XOÁ NHIỆM VỤ
            if(isset($_POST['deletebtn'])){
              $id = $_POST['idtodo'];
                  $query = mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `idaccount` = '$account' AND `id` = '$id'");
                  if($query){
                    echo '<script>window.location.href="'.$url.'";</script>';
                  }else{
                    echo '<script>window.location.href="404.php";</script>';
                  }
            }
            if(isset($_POST['updatetodo'])){
              $id = $_POST['idtodo'];
              $updatedaytodo = $_POST['updatedaytodo'];
              $updatenametodo = $_POST['updatenametodo'];
              $updatedaytodo = mysqli_real_escape_string($conn,date("d-m-Y", strtotime($updatedaytodo)));
              $dateht = date('d-m-Y');
             
              $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `noidung`= '$updatenametodo', `ngayth`='$updatedaytodo' WHERE `idaccount` = '$account' AND `id` = '$id'");
              if($query){
                echo '<script>window.location.href="'.$url.'";</script>';
              }else{
                echo '<script>window.location.href="404.php";</script>';
              }
            
            }
            // VÒNG LẶP CỦA TODO
            if($show2 > 0){
            foreach($show as $row){
            if($row['pin'] == 1){
              $status = '0';
              $namebtn = 'Bỏ Ghim';
              $name = 'name="unpinbtn"';
             $color = 'orange-icon';
            }else{
              $status = '1';
              $namebtn = 'Ghim'; 
              $name = 'name="pinbtn"';
              $color = 'green-icon';
            }
            ?>
          <form action="<?php echo $url;?>" method="POST">
            <label class="list-group-item d-flex gap-3">
                <input type="hidden" name="idtodo" value="<?php echo $row['id'];?>">
                
                                <button type="submit" class="btn finishbtn icon" name="finishbtn" data-bs-toggle="tooltip" title="Hoàn thành"><i class="bi bi-circle <?php echo $color;?> icon-unlock"></i><i class="bi bi-check-circle-fill <?php echo $color;?> icon-lock"></i></button>

                
                <a class="btn btn-lg w-100 d-flex justify-content-start" data-bs-toggle="collapse" href="#collapseExample<?php echo $row['id'];?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                <strong><?php echo $row['noidung']?></strong>
                </a>
                <div class="dropdown">
                    <span data-bs-toggle="tooltip" title="Tuỳ chọn">
                    <button type="button" class="btn"><i class="bi bi-three-dots"></i></button>
                    </span>
                    <div class="btn-group-vertical">
                        <button type="button" class="btn d-flex gap-3 btn-green" data-bs-toggle="modal" href="#editmodel<?php echo $row['id']?>" role="button"><i class="bi bi-pencil-square"></i>Chỉnh sửa</button>
                    <button type="submit" class="btn d-flex gap-3 text-nowrap btn-ogange" <?php echo $name;?>><i class="bi bi-pin"></i><?php echo $namebtn;?></button>
                    <button type="button" class="btn d-flex gap-3 btn-red" data-bs-toggle="modal" href="#deletemodel<?php echo $row['id']?>" role="button"><i class="bi bi-trash"></i>Xoá</button>
                    </div>
                  </div>          
            </label>
            
            <div class="collapse" id="collapseExample<?php echo $row['id'];?>">
              <div class="list-group-item d-flex gap-3 flex-column">
                  <div class="date">
                  <small class="d-block text-muted">
                  <i style="color:#008f63" class="bi bi-calendar-plus"></i>
                    Ngày thêm: <?php echo $row['ngaythem']?>
                  </small>
                  </div>
                  <div class="datefinish">
                  <small class="d-block text-muted">
                  <i style="color:#008f63" class="bi bi-calendar-check"></i>
                    Ngày thực hiện: <?php echo $row['ngayth']?>
                  </small>
                  </div>
                  <div class="pin">
                  <small class="d-block text-muted">
                  <i style="color:#ff7000" class="bi bi-pin-angle-fill"></i>
                  Ghim việc: <?php 
                  if($row['pin'] == 1){
                    echo 'Đang ghim';
                  }else{
                    echo 'Chưa ghim';
                  }
                  ?>
                </small>
                  </div>
              </div>
            </div>
             <!----XOÁ CÔNG VIỆC-->

            <div class="modal fade" id="deletemodel<?php echo $row['id']?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-content1 rounded-4 shadow">
                        <div class="modal-body p-4 text-center">
                       
                            <h5 class="mb-0 ">Cảnh báo!</h5>
                            <p class="mb-0">Bạn có chắc khi xoá công việc này?</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <button type="button" class="btn btn-lg  btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" data-bs-dismiss="modal" aria-label="Close" ><strong>Huỷ</strong></button>
                            <button type="submit"  class="btn btn-lg red1 btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 close "name="deletebtn"  >Có</button>
                        </div>
                    </div>
                </div>
            </div>
            <!----CHỈNH SỬA CÔNG VIỆC-->
            <div class="modal fade" id="editmodel<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title green-title" id="exampleModalLabel">Sửa công việc</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                    <div class="mb-4">
                                        <label class="form-label" for="contactsFormLasttName">Danh sách</label>
                                        <input class="form-control" type="text"  value="<?php echo $list;?>" disabled />
                                        <input type="hidden" name="namelist" value="<?php echo $list;?>" />
                                    </div>
                                
                                
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="blogContactsFormLasttName">Ngày thực hiện</label>
                                        <input class="form-control" type="date" name="updatedaytodo" value="<?php
                                        $daytodo = mysqli_real_escape_string($conn,date("Y-m-d", strtotime($row['ngayth'])));
                                         echo $daytodo;

                                         ?>">
                                    </div>
                                </div>
                            </div>

                            <span class="d-block mb-3">
                                <label class="form-label" for="blogContactsFormComment">Tên công việc</label>
                                <textarea class="form-control" name="updatenametodo" rows="3"><?php echo $row['noidung']?></textarea>
                            </span>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="updatetodo" class="btn btn1 btn-lg orange w-100 mx-0 mb-2">Sửa</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <?php
            }
            }else{
                echo '<div class="text-center">
                <img src="asset/image/c.png" width="70%"><br>
                 <p><h5>Hãy thêm công việc của bạn</h5></p>
             </div>';
            }
            ?>
            
            </div>
    </div>
</div>
</div>
<style>
  
  /*hover button*/
  .icon:hover .icon-unlock,
.icon .icon-lock {
    display: none;
}
.icon:hover .icon-lock {
    display: inline;
}
  
  .green-icon{
    color: #008f63;
  }
  .orange-icon{
    color: #ff7000;
  }
    .modal1 {
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
.modal-content1 {
background-color: #fefefe;
margin: 15% auto;
/* 15% from the top and centered */
padding: 20px;
border: 1px solid #888;
width: 380px;
/* Could be more or less, depending on screen size */
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
   .dropdown-title:not(.nohover):hover button{
    color:none;
  }
  .dropdown-title div{
    background-color:#fff;
    box-shadow:0 4px 8px rgba(0,0,0,0.2);
    z-index:1;
    visibility:hidden;
    position:absolute;
    min-width:100%;
    opacity:0;
    transition:.3s;
    border-radius: .25rem;
  }
  .dropdown-title:hover div{
    visibility:visible;
    opacity:1;
  }
  .dropdown-title {
    display:inline-block;
    position:relative;
  }

  .dropdown-title button{
    border:none;
    padding:8px 25px;
    background-color: #f0f0f0;
    transition:.3s;
    cursor:pointer;
  }
  .red1{
      color: #fb3647;
      background-color: #ffff;
    }
    .red1:hover{
      color: #c2334e;
      background-color: #ffff;
    }
  .btn-title{
    background-color: #fff!important;
    color:#fb3647!important;
  }
  .btn-title:hover{
    color: #fff!important;
    background-color: #fb3647!important;
  }
  .btn-red:hover{
    color: #fff;
    background-color: #fb3647;
  }
  .btn-ogange:hover{
    color: #fff;
    background-color: #ff7000;
  }
  .btn-red{
    border-color: #fb3647 !important;
    color:#fb3647;
  }
  .btn-ogange{
    border-color: #ff7000 !important;
    color:#ff7000;
  }
  .orange{
    background-color:#ff7000;
    color: #fff;
  }
  .orange:not(.nohover):hover{
    background-color:#ff7000;
    color: #fff;
  }
  .btn-ogange:not(.nohover):hover{
    color:none;
  }
  .btn-red:not(.nohover):hover{
    color:none;
  }
  .dropdown{
    display:inline-block;
    position:relative;
  }

  .dropdown button{
    
    border:none;
    padding:8px 25px;
    background-color:#fff;
    transition:.3s;
    cursor:pointer;
  }
  .red{
      color: #fff;
      background-color: #fb3647;
    }
    .red:hover{
        color: #fff;
      background-color: #c2334e!important;
    }
  .dropdown:not(.nohover):hover button{
    color:none;
  }
  
  .dropdown div{
    background-color:#fff;
    box-shadow:0 4px 8px rgba(0,0,0,0.2);
    z-index:1;
    visibility:hidden;
    position:absolute;
    min-width:100%;
    opacity:0;
    transition:.3s;
    border-radius: .25rem;
  }
  .dropdown-title:active div{
    visibility:visible;
    opacity:1;
  }
  .dropdown:hover div{
    visibility:visible;
    opacity:1;
  }
  .button-head {
      color: #ff7000;
      border-radius: 10px;
      background-color: #ffff;
    }
    .button-head:hover {
        color: #ff7000;
        background-color: #ffff;
        box-shadow:0 4px 8px rgba(0,0,0,0.2);
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
  .green-title {
    color: #008f63;
      background-color: #ffff;
    }
.btn-green{
    border-color: #008f63 !important;
    color:#008f63;
  }
  .btn-green:hover{
    color: #fff;
    background-color: #008f63;
  }
    .green{
      color: #ffff;
      background-color: #008f63;
    }
     .green1{
        color: #008f63!important;
        background-color: #ffff!important;
      }
      .form-switch {
 padding-left: 0em;
}
.form-check {
padding-left: 0em; 
}
.popover-header {
    padding: .5rem 1rem;
    margin-bottom: 0;
    font-size: 1rem;
    background-color: #f0f0f0;
    border-bottom: 1px solid rgba(0,0,0,.2);
    border-top-left-radius: calc(.3rem - 1px);
    border-top-right-radius: calc(.3rem - 1px);
}
.form-check-input:checked + .form-checked-content {
      opacity: .5;
    }

    .form-check-input-placeholder {
      pointer-events: none;
      border-style: dashed;
    }
    [contenteditable]:focus {
      outline: 0;
    }
.sidenav {
 /* 100% Full-height */
  width: 0px;/* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */ /* Stay at the top */
  right: 0;
 /* Disable horizontal scroll */
 /* Place content 60px from the top */
  transition: 0.001s; /* 0.5 second transition effect to slide in the sidenav */
  background-color: #fff;
}

.list-group {
  width: 80%;
  max-width: 500px;
  margin: 4rem auto;
}
.icon-lg{
    font-size: 2rem;
}
.form-check-input:checked + .form-checked-content {
  opacity: .5;
}

    .form-check .form-check-input {
        float: none;
        margin: 5px;
    }

.form-check-input-placeholder {
  pointer-events: none;
  border-style: dashed;
}
[contenteditable]:focus {
  outline: 0;
}

.list-group-checkable {
  display: grid;
  gap: .5rem;
  border: 0;
}
.list-group-item {
  position: relative;
  display: block;
  padding: .5rem 1rem;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  color: #212529;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,.125);
  border-bottom-width: 0.5px;
    
}

.list-group-item:first-child {
        border-top-left-radius: inherit;
        border-top-right-radius: inherit;
    }
.list-group-checkable .list-group-item {
  cursor: pointer;

}
.list-group-item-check {
  position: absolute;
  clip: rect(0, 0, 0, 0);
  pointer-events: none;
}
.list-group-item-check:hover + .list-group-item {
  background-color: var(--bs-light);
}
.list-group-item-check:checked + .list-group-item {
  color: #fff;
  background-color: var(--bs-blue);
}
.list-group-item-check[disabled] + .list-group-item,
.list-group-item-check:disabled + .list-group-item {
  pointer-events: none;
  filter: none;
  opacity: .5;
}
.icon-square {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 2rem;
  height: 2rem;
  font-size: 1.2rem;
  margin-right: 10px;
  border-radius: .60rem;
  color:#ffff!important;
  background-color: #008f63;
  margin-left: 10px;
  margin-right: 20px;
}
</style>
<?php
}
include 'include/foot.php';
?>
<script>
$(window).on('load',function(){
$(".loader").fadeOut(1000);
$(".content").fadeIn(1000);
});
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
var toastLiveExample = document.getElementById('liveToast')
var toast = new bootstrap.Toast(toastLiveExample)
    toast.show()
</script>