<?php
include 'include/head.php';
//BẮT LẤY 2 BIẾN TRUYỀN ĐI
$list = trim(htmlspecialchars(addslashes($_GET['list'])));
$icon = trim(htmlspecialchars(addslashes($_GET['icon'])));
if($list == 1){
    $name = 'Tất cả';
    $show = mysqli_query($conn,"SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0");
    $color = "red";
    $colortitle = "#fb3647";
}elseif($list == 2){
    $name = 'Việc ghim';
    $show = mysqli_query($conn,"SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0 AND `pin` = 1");
    $color = "orange";
    $colortitle = "#ff7000";
}else{
    $name = 'Việc thường';
    $show = mysqli_query($conn,"SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0 AND `pin` = 0");
    $color = "yellow";
    $colortitle = "#fdc324";
}
//LẤY LINK HIỆN TẠI
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
<div class="container" style="margin-top: 50px;">
<div class="row">
<div class="col d-flex justify-content-start">
    <div class="d-flex align-items-center">
    <button class="btn btn-lg" onclick="location.href='list.php'"><i class="bi bi-chevron-left icon-lg"></i></button>
    <i class="bi bi-<?php echo $icon;?> icon-square <?php echo $color;?>"></i>
    <h2 style="color:  <?php echo $colortitle;?>"><?php echo $name;?></h2>
    
</div>
</div>
</div>
<div class="row justify-content-center">
    <div class="list-group">
    <?php
            // HOÀN THÀNH NHIỆM VỤ
            if(isset($_POST['finishbtn'])){
              $id = $_POST['idtodo'];
              $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `checklist`= 1 WHERE `id` = '$id'");
              if($query){
                echo '<script>window.location.href="'.$url.'";</script>';
              }else{
                echo '<script>window.location.href="404.php";</script>';
              }
            }
            //GHIM HOẶC BỎ GHIM
            if(isset($_POST['unpinbtn'])){
              $id = $_POST['idtodo'];
                  $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `pin` = 0 WHERE `id` = '$id'");

                  if($query){
                    echo '<script>window.location.href="'.$url.'";</script>';
                  }else{
                      echo '<script>window.location.href="404.php";</script>';
                  }
          }elseif(isset($_POST['pinbtn'])){
            $id = $_POST['idtodo'];
            $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `pin`= 1 WHERE `id` = '$id'");

            if($query){
              echo '<script>window.location.href="'.$url.'";</script>';
            }else{
                echo '<script>window.location.href="404.php";</script>';
            }
          }
            //XOÁ NHIỆM VỤ
            if(isset($_POST['deletebtn'])){
              $id = $_POST['idtodo'];
                  $query = mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `id` = '$id'");
                  if($query){
                    echo '<script>window.location.href="'.$url.'";</script>';
                  }else{
                    echo '<script>window.location.href="404.php";</script>';
                  }
            }
            // VÒNG LẶP CỦA TODO
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
                    <button type="submit" class="btn d-flex gap-3 text-nowrap btn-ogange" <?php echo $name;?>><i class="bi bi-pin"></i><?php echo $namebtn;?></button>
                    <button type="button" class="btn d-flex gap-3 btn-red" data-bs-toggle="modal" href="#deletemodel<?php echo $row['id']?>" role="button"><i class="bi bi-trash"></i>Xoá</button>
                    </div>
                  </div>          
            </label>
            <div class="collapse" id="collapseExample<?php echo $row['id'];?>">
              <div class="list-group-item d-flex gap-3 flex-column">
                  <div class="list">
                  <small class="d-block text-muted">
                  <i style="color:#fb3647" class="bi bi-list"></i>
                    Danh sách: <?php echo $row['danhsach']?>
                  </small>
                  </div>
                  <div class="date">
                  <small class="d-block text-muted">
                  <i style="color:#008f63" class="bi bi-calendar-plus"></i>
                    Ngày thêm: <?php echo $row['ngaythem']?>
                  </small>
                  </div>
                  <div class="date">
                  <small class="d-block text-muted">
                  <i style="color:#008f63" class="bi bi-calendar-check"></i>
                    Ngày thêm: <?php echo $row['ngayth']?>
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
            <div class="modal fade" id="deletemodel<?php echo $row['id']?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-content1 rounded-4 shadow">
                        <div class="modal-body p-4 text-center">
                       
                            <h5 class="mb-0 red1">Cảnh báo!</h5>
                            <p class="mb-0">Bạn có chắc khi xoá công việc này?</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <button type="submit" class="btn btn-lg red1 btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right" name="deletebtn"  >Có, tôi muốn</button>
                            <button type="button" class="btn btn-lg red1 btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 close " data-bs-dismiss="modal" aria-label="Close"><strong>Không</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <?php
            }
            ?>

            </div>
    </div>
</div>
<style>
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
  .dropdown-title:active div{
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
  
  .dropdown:hover div{
    visibility:visible;
    opacity:1;
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
    background-color:#ff7000!important;
    color: #fff!important;
    }
    .yellow {
      background-color: #fdc324!important;
      color: #fff!important;
    }
    .red{
      background-color: #fb3647!important;
      color: #fff!important;
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
  .list-group {
  width: 80%;
  max-width: 500px;
  margin: 4rem auto;
}
.icon-lg{
    font-size: 2rem;
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
.red1{
      color: #fb3647;
      background-color: #ffff;
    }
    .red1:hover{
      color: #c2334e;
      background-color: #ffff;
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
}
include 'include/foot.php';
?>
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

</script>