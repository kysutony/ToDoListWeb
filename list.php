<?php
include 'include/head.php';
$show = mysqli_query($conn, "SELECT * FROM `danhsach` WHERE `idaccount` = '$account'");
$icon = array("eye" ,"book","person","lightbulb", "pencil", "folder", "paperclip", "link" ,"moon", "cloud" ,"heart" ,"star", "flag" ,"tag" ,"camera" ,"bookmark", "gear", "command", "sunrise", "tornado","phone","envelope", "bag", "cart","hammer", "house", "clock", "alarm");
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
<!--TITLE-->
<div class="container" style="margin-top: 50px;">
<div class="row">
    <div class="col">
    <div class="d-flex justify-content-start">
    <span class="title-head"><img src="asset/icontitle.png" class="icon-head">Danh sách</span>
    </div>
    </div>
    <div class="col"></div>
    <div class="col d-flex justify-content-center">
      <div class="d-flex align-items-center">
      <span data-bs-toggle="modal" data-bs-target="#exampleModal">
      <button  type="button" class="btn d-flex gap-3 button-head" data-bs-toggle="tooltip" title="Thêm danh sách"><i class="bi bi-plus-square-fill"></i>Thêm danh sách</button>
      </span>
      </div>
    </div>
  </div>
  <!---THÊM DANH SÁCH-->
  <?php
        if(isset($_POST['adddata'])){
          $namelist = $_POST['addnamelist'];
          $icon = $_POST['addicon'];
          $select = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `danhsach` WHERE `idaccount` = '$account' AND tendanhsach = '$namelist'"));
          if($select > 0 ){
               echo '<div  aria-live="polite" aria-atomic="true" class="toast-container position-absolute  top-0 start-50 translate-middle-x p-3">
            <!-- Then put toasts within -->
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <img src="asset/Icon.png" class="rounded me-2" width="35px">
                <strong class="me-auto">Cảnh báo</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                Danh sách đã tồn tại.
                </div>
            </div>
        </div>';
         echo '<script>setTimeout(function () {
        window.location.href="list.php"
    }, 2000);</script>';
          }else{
              $query = mysqli_query($conn, "INSERT INTO `danhsach`(`idaccount`, `tendanhsach`, `icon`) VALUES ('$account','$namelist','$icon')");
          if($query){
              echo '<script>window.location.href="list.php";</script>';
              
          }else{
            echo '<script>window.location.href="404.php";</script>';
          }
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
                                      
                                      <input class="form-check-input" type="radio" checked="checked" name="addicon" value="'.$icon[$x].'">

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
                                    <input class="form-control" name="addnamelist" placeholder="Thêm nội dung tại đây...">
                                    <!-- <textarea class="form-control" name="addidaccount" id="addidaccount" placeholder="Thêm nội dung tại đây..." aria-label="Thêm nội dung tại đây..." rows="1"></textarea> -->
                                </span>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" name="adddata" class="btn singlebutton btn-lg red w-100 mx-0 mb-2">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!--HIỂN THỊ TỔNG DANH SÁCH-->
<div class="row justify-content-center">
<div class="list-group">
  <!---LIST HỆ THỐNG--->
  <a href="systemlist.php?list=1&icon=inboxes" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <div class="icon-square red text-dark flex-shrink-0 me-3">
      <i class="bi bi-inboxes"></i>
      </div>
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div class="align-self-center">
          <h6 class="mb-0"><strong>Tất cả</strong></h6>
          <!-- <p class="mb-0 opacity-75"></p> -->
        </div>
        <div class="text-nowrap">
        <span class="badge green rounded-pill"><?php
              $list = $row['tendanhsach'];
              $show1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0");
              $num = mysqli_num_rows($show1);
        echo $num;?></span>
        <!-- <button class="btn badge red rounded-pill" type="button"><i class="bi bi-trash2-fill"></i> Xoá</button> -->
        
        </div>
      </div>
    </a>
    <a href="systemlist.php?list=2&icon=pin" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <div class="icon-square orange text-dark flex-shrink-0 me-3">
      <i class="bi bi-pin"></i>
      </div>
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div class="align-self-center">
          <h6 class="mb-0"><strong>Việc ghim</strong></h6>
          <!-- <p class="mb-0 opacity-75"></p> -->
        </div>
        <div class="text-nowrap">
        <span class="badge green rounded-pill"><?php
              $list = $row['tendanhsach'];
              $show1 = mysqli_query($conn,"SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0 AND `pin` = 1");
              $num = mysqli_num_rows($show1);
        echo $num;?></span>
        <!-- <button class="btn badge red rounded-pill" type="button"><i class="bi bi-trash2-fill"></i> Xoá</button> -->
        
        </div>
      </div>
    </a>
    <a href="systemlist.php?list=3&icon=list" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <div class="icon-square yellow text-dark flex-shrink-0 me-3">
      <i class="bi bi-list"></i>
      </div>
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div class="align-self-center">
          <h6 class="mb-0"><strong>Việc thường</strong></h6>
          <!-- <p class="mb-0 opacity-75"></p> -->
        </div>
        <div class="text-nowrap">
        <span class="badge green rounded-pill"><?php
              $list = $row['tendanhsach'];
              $show1 = mysqli_query($conn,"SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0 AND `pin` = 0");
              $num = mysqli_num_rows($show1);
        echo $num;?></span>
        <!-- <button class="btn badge red rounded-pill" type="button"><i class="bi bi-trash2-fill"></i> Xoá</button> -->
        
        </div>
      </div>
    </a>
    <!---LIST NGƯỜI DÙNG--->
    <div class="d-flex py-3">
    <p style="color: gray">DANH SÁCH VIỆC CỦA TÔI</p>
    </div>
    
    <?php
    foreach($show as $row){
    ?>
  <a href="todo.php?idlist=<?php echo $row['id'];?>&list=<?php echo $row['tendanhsach'];?>&icon=<?php echo $row['icon'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
    <div class="icon-square green text-dark flex-shrink-0 me-3">
        <i class="bi bi-<?php echo $row['icon'];?>"></i>
    </div>
    <div class="d-flex gap-2 w-100 justify-content-between">
      <div class="align-self-center">
        <h6 class="mb-0"><strong><?php echo $row['tendanhsach'];?></strong></h6>
        <!-- <p class="mb-0 opacity-75"></p> -->
      </div>
      <div class="text-nowrap">
      <span class="badge green rounded-pill"><?php
            $idlist = $row['id'];
            $list = $row['tendanhsach'];
            $show1 = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `id_list`='$idlist' AND `danhsach` = '$list' AND `idaccount` = '$account' AND `checklist` = 0");
            $num = mysqli_num_rows($show1);
      echo $num;?></span>
      <!-- <button class="btn badge red rounded-pill" type="button"><i class="bi bi-trash2-fill"></i> Xoá</button> -->
      
      </div>
    </div>
  </a>
  <?php
    }
  ?>
</div>
</div>
</div>
<!--CSS-->
<style>
  p {
    margin-top: 0;
    margin-bottom: 0;
}
  /*color*/
    .button-head {
      color: #fb3647;
      border-radius: 10px;
      background-color: #ffff;
    }
    .button-head:hover {
        color: #fb3647;
        background-color: #ffff;
        box-shadow:0 4px 8px rgba(0,0,0,0.2);
    }
    .green1{
        color: #008f63!important;
        background-color: #ffff!important;
      }
    .green:hover{
      color: #ffff!important;
      background-color: #027048!important;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 4px 8px 0 rgba(0, 0, 0, 0.3)!important ;
    }
    .green {
        background-color: #008f63;
    }
    .orange{
    background-color:#ff7000;
    color: #fff;
    }
    .yellow {
      background-color: #fdc324;
      color: #fff;
    }
    .red{
      background-color: #fb3647;
    }
    .red:hover{
      background-color: #c2334e!important;
    }
    .red1{
      color: #fb3647;
      background-color: #ffff;
    }
    .red1:hover{
      color: #c2334e;
      background-color: #ffff;
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
    /*iconlist*/
    .icon-square {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 2rem;
      height: 2rem;
      font-size: 1rem;
      border-radius: .60rem;
      color:#ffff!important;
    }
    /*listgroup*/
    .opacity-50 { opacity: .5; }
    .opacity-75 { opacity: .75; }

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
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
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

    .form-check .form-check-input {
        float: none;
        margin: 5px;
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
var toastLiveExample = document.getElementById('liveToast')
var toast = new bootstrap.Toast(toastLiveExample)
    toast.show()
</script>