<?php
include 'include/head.php';
//TRUY VẤN 
$show = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 1 AND `pin` = 1");
$show1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 1 AND `pin` = 0");
$show3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `danhsach` WHERE `idaccount` = '$account'"));
$show4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account'"));
$show5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0"));
$show6 = mysqli_num_rows($show);
$show7 = mysqli_num_rows($show1);
$show8 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 1"));

// NÚT DỌN DẸP
if(isset($_POST['dondep'])){
  $query = mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 1");
  if($query){
    echo '<script>window.location.href="statistic.php";</script>';
}else{
    echo '<script>window.location.href="404.php";</script>';
}
}
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
    <div class="col">
    <div class="d-flex justify-content-start">
    <span class="title-head"><img src="asset/iconbutton/icontitle.png" class="icon-head">Thống kê</span>
    </div>
    </div>
    <div class="col"></div>
    <div class="col d-flex justify-content-center">
      <div class="d-flex align-items-center">
     <form action="statistic.php" method="POST">
     <span data-bs-toggle="modal" data-bs-target="#exampleModal">
      <button name="dondep" type="submit" class="btn button-head d-flex gap-3" data-bs-toggle="tooltip" title="Xoá những việc đã hoàn thành"><i class="bi bi-x-circle-fill"></i>Dọn dẹp</button><!---NÚT XOÁ TODO ĐÃ XONG--->
      </span>
     </form>
      </div>
    </div>
  </div>
    <!----DANH SÁCH TỔNG HỢP CÔNG VIỆC--->
  <div class="row d-none d-sm-block d-sm-none d-md-block">
   <div class="col d-flex flex-row justify-content-center">
   <div class="listdashboard d-flex flex-row">
   <div class="content d-flex flex-column">
     <h4><?php echo $show3;?></h4>
     <p>Danh sách</p>
     </div>
     <div class="content d-flex justify-content-between align-items-center">
     <i class="bi bi-list size"></i>
     </div>
   </div>

   <div class="listdashboard d-flex flex-row">
   <div class="content d-flex flex-column">
     <h4><?php echo $show4;?></h4>
     <p>Công việc</p>
     </div>
     <div class="content d-flex justify-content-between align-items-center">
     <i class="bi bi-card-list size"></i>
     </div>
   </div>
   <div class="listdashboard d-flex flex-row">
   <div class="content d-flex flex-column">
     <h4><?php echo $show5;?></h4>
     <p>Việc chưa hoàn thành</p>
     </div>
     <div class="content d-flex justify-content-between align-items-center">
     <i class="bi bi-check-circle-fill size"></i>
     </div>
   </div>
   <div class="listdashboard d-flex flex-row">
   <div class="content d-flex flex-column">
     <h4><?php echo $show8;?></h4>
     <p>Việc hoàn thành</p>
     </div>
     <div class="content d-flex justify-content-between align-items-center">
     <i class="bi bi-check-circle-fill size"></i>
     </div>
   </div>
   </div>
 </div>
  <!--NÚT TAB -->
<div class="row d-flex justify-content-center">
<ul class="nav nav-pills mb-3 tabbutton" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="btn buttontab active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-pin-fill"></i></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="btn buttontab" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-list"></i></button>
        </li>
    </ul>
</div>

<!---TAB 1--->
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <div class="row justify-content-center">
    
     <!---LIST CÔNG VIỆC HOÀN THÀNH--->
  <div class="list-group">
  <?php
  //TRUY VẤN 
  if($show6 == 0){
    echo '
                <div class="text-center">
                    <img src="asset/image/done-5.png" width="70%"><br>
                     <p><h5>Hãy hoàn thành công việc của bạn</h5></p>
                 </div>
    ';
  }else{
    echo '
    <div class="d-flex">
    <p style="color: gray">CÔNG VIỆC GHIM ĐÃ HOÀN THÀNH</p>
    </div>';
  }
    //VÒNG LẶP TODO
    foreach($show as $row){
    ?>
        <a class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="collapse" href="#collapseExample<?php echo $row['id']?>" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class="bi bi-check-circle-fill icon-lg green-icon"></i>
            <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0"><?php echo $row['noidung']?></h6>
            </div>
            </div>
        </a>
        <div class="collapse" id="collapseExample<?php echo $row['id']?>">
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
    <?php
    }
    ?>
</div>
 
  </div>
</div>
<!---TAB 2--->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="row justify-content-center">
    <!---LIST CÔNG VIỆC HOÀN THÀNH--->
  <div class="list-group">
  <?php
  if($show7 == 0){
    echo '
                <div class="text-center">
                    <img src="asset/image/done-5.png" width="70%"><br>
                     <p><h5>Hãy hoàn thành công việc của bạn</h5></p>
                 </div>
    ';
  }else{
    echo '
    <div class="d-flex">
    <p style="color: gray">CÔNG VIỆC THƯỜNG ĐÃ HOÀN THÀNH</p>
    </div>';
  }
  //VÒNG LẶP TODO
    foreach($show1 as $row){
    ?>
        <a class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="collapse" href="#collapseExample<?php echo $row['id']?>" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class="bi bi-check-circle-fill icon-lg green-icon"></i>
            <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0"><?php echo $row['noidung']?></h6>
            </div>
            </div>
        </a>
        <div class="collapse" id="collapseExample<?php echo $row['id']?>">
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
    <?php
    }
    ?>
</div>
  </div>
</div>
</div>
</div>
</div>
<style>
    .green-icon{
    color: #008f63;
  }
    .icon-lg{
    font-size: 1.3rem;
}
.img-avt{
  border-radius: 10px;
}
    .list-group {
      width: 100%;
      max-width: 460px;
      margin: 4rem auto;
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

    .list-group-checkable {
      display: grid;
      gap: .5rem;
      border: 0;
    }
    .list-group-checkable .list-group-item {
      cursor: pointer;
      border-radius: .5rem;
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
    .gap-2 {
        gap: .5rem !important;
    }
    .w-100 {
        width: 100% !important;
    }
    
    .list-group-item:first-child {
        border-top-left-radius: inherit;
        border-top-right-radius: inherit;
    }
    .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    .gap-3 {
        gap: 1rem !important;
    }
    
    .list-group-item {
        position: relative;
        display: block;
        padding: .5rem 1rem;
        padding-top: 0.2rem;
        padding-bottom: 0.2rem;
        color: #212529;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.125);
    }
    .list-group-item-action {
        width: 100%;
        color: #495057;
        text-align: inherit;
    }
    .col-sm-6 {
        flex: 0 0 auto;
        width: 100%;
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
    .listdashboard{
      box-shadow: 0 25px 20px -30px rgba(0, 0, 0, 0.3), 0 0 15px rgba(0, 0, 0, 0.06);
        max-width: 18rem;
        min-width: 11rem;
        background-color: #fff;
        margin: 2rem;
        border-bottom: 8px solid #008f63;
       
    }
    .content{
  padding: 15px;
  padding-bottom: 5px;
}
.size{
  font-size: 25px;
  color: #008f63;
  
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