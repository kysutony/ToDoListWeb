<?php
include 'include/head.php';
$show = mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `pin` = 1 AND `checklist` = 0");
$show1 = mysqli_query($conn, "SELECT * FROM `danhsach` WHERE `idaccount` = '$account'");
// $show2 = mysqli_query($conn, "SELECT TOP(5) danhsach FROM `nhiemvu` WHERE `idaccount` = '$account' ORDER BY ");
$show2 = mysqli_query($conn, "SELECT danhsach, COUNT(*) FROM nhiemvu WHERE `idaccount` = '$account' AND `checklist` = 0 GROUP BY danhsach DESC having count(*) >= 3 ");
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
      <div class="content">
        <div class="row">
    <div class="col d-flex justify-content-start">
    
    <span class="title-head"><img src="asset/icontitle.png" class="icon-head">Việc đã ghim</span>
   
    </div>
    <div class="col"></div>
    <div class="col d-flex justify-content-end"> 
    <div class="topbar d-flex align-items-center">
    <div class="buttonbar d-none d-sm-block d-sm-none d-md-block">
        <button class="btn button-head ogange" data-bs-toggle="tooltip" title="Thêm công việc" onclick="location.href='list.php'"><i class="bi bi-plus-circle-fill"></i></button>
        <button class="btn button-head red" data-bs-toggle="tooltip" title="Thêm danh sách" onclick="location.href='list.php'"><i class="bi bi-plus-square-fill"></i></button>
     </div>
      <a href="account.php" data-bs-toggle="tooltip" title="Tài khoản">
      <div class="accountinfo">
      <img class="img-avt" src="asset/icon/<?=$r_user['avatar']?>.png" width="40px">
          <strong><?=$r_user['account']?></strong>
      </div>
      </a>
    </div>
     
    </div>
  </div>
  <!--DANH SÁCH NỔI BẬT-->
    <div class="row">
<div class="col"></div>
<div class="col-10">
    <div class="list-bar text-decoration-none d-none d-sm-block d-sm-none d-md-block">
    <div class="d-flex flex-row mb-3">
    <h5 class="d-flex align-items-center me-3" style="color: gray">DANH SÁCH NỔI BẬT</h5>

    <?php
            foreach($show2 as $row){
        ?>
        <div class="list d-flex flex-row p-2">
        <div class="icon-list">
        <div class="icon-square flex-shrink-0 me-3">
                <?php
                $list = $row['danhsach'];
                $show3 =  mysqli_query($conn, "SELECT * FROM `danhsach` WHERE `idaccount` = '$account' AND `tendanhsach` = '$list' ");
                foreach($show3 as $row1){
                    echo '<i class="bi bi-'.$row1['icon'].'"></i>';
                }
                ?>
            </div>
        </div>
                <span class="namelisttop">
            <?php echo $row['danhsach'];?>
                </span>
                <span class="numlist">
        <?php echo $row['COUNT(*)'];?>
                </span>
            </div>
        <?php
      }
        ?>
    </div>
    </div>
</div>
<div class="col"></div>
    </div>
  <!---DANH SACH VIỆC GHIM-->
  <div class="row  d-flex justify-content-center">
        <div class="col text-decoration-none d-none d-sm-block d-sm-none d-md-block">
        </div>
        <div class="col-8">
       
       <?php
            if(isset($_POST['unpinbtn'])){
                $id = $_POST['idtodo'];
                $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `pin`='0' WHERE `idaccount` = '$account' AND `id` = '$id'");
                if($query){
                    echo '<script>window.location.href="index.php";</script>';
                     echo '<script>$(window).on("load",function(){
$(".loader").fadeOut(1000);
$(".content").fadeIn(1000);
});</script>';
                }else{
                    echo '<script>window.location.href="404.php";</script>';
                }
            }
            if(isset($_POST['finishbtn'])){
                $id = $_POST['idtodo'];
                $query = mysqli_query($conn, "UPDATE `nhiemvu` SET `checklist`= 1 WHERE `id` = '$id'");
                if($query){
                    echo '<script>window.location.href="index.php";</script>';
                }else{
                  echo '<script>window.location.href="404.php";</script>';
                }
              }
            if(isset($_POST['deletebtn'])){
                $id = $_POST['idtodo'];
                    $query = mysqli_query($conn, "DELETE FROM `nhiemvu` WHERE `id` = '$id'");
                    if($query){
                        echo '<script>window.location.href="index.php";</script>';
                    }else{
                      echo '<script>window.location.href="404.php";</script>';
                    }
              }
              $show4 =  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `nhiemvu` WHERE `idaccount` = '$account' AND `checklist` = 0 AND `pin` = 1"));
              if($show4 == 0){
                echo '
                <div class="d-flex flex-column align-items-center ">
                    <img src="asset/image/e.png" width="50%">
                     <h5>Hãy ghim công việc của bạn</h5>
                
                ';
            }else{
                echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 d-flex justify-content-center">';
            }
            foreach($show as $row){
                ?>
        <div class="col">
        <div class="task">
        <div class="card-body">
            <div class="title">
                <strong><?php echo $row['noidung'];?></strong>
            </div>
       <div class="d-flex justify-content-center">
                    <form action="index.php" method="POST">
                    <button type="submit" class="btn" data-bs-toggle="tooltip" title="Bỏ ghim" name="unpinbtn"><i class="bi bi-pin"></i></i></button><!---NÚT BỎ GHIM-->
                    <button type="submit" class="btn" data-bs-toggle="tooltip" title="Hoàn thành" name="finishbtn"><i class="bi bi-check-circle"></i></button><!---NÚT HOÀN THÀNH--->
                    <button type="submit" class="btn" data-bs-toggle="tooltip" title="Xoá" name="deletebtn"><i class="bi bi-trash"></i></button><!---NÚT XOÁ-->
                    <input type="hidden" name="idtodo" value="<?php echo $row['id'];?>">
                    </form>
                    <span data-bs-toggle="tooltip" title="Xem thêm">
                    <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo<?php echo $row['id'];?>" aria-expanded="false" aria-controls="flush-collapseTwo"><!---NÚT XEM THÊM--->
                        <i onclick="myFunction(this)" class="bi bi-chevron-down"></i>
                    </button>
                    </span>
       </div>
       <!----CHỖ HIỆN THÔNG TIN XEM THÊM--->
            <div class="accordion" id="accordionExample">
                <div class="accordion-item" style="border: none;">
                     <div id="flush-collapseTwo<?php echo $row['id'];?>" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="d-flex align-items-center space">
                                <span data-bs-toggle="tooltip" data-bs-placement="left" title="Danh sách">
                                    <div class="icon-square green flex-shrink-0 me-3">
                                        <i class="bi bi-<?php
                                            $list = $row['danhsach'];
                                            $show1 = mysqli_query($conn, "SELECT * FROM `danhsach` WHERE `idaccount` = '$account' AND `tendanhsach` = '$list'");
                                            foreach($show1 as $row1){
                                            echo $row1['icon'];
                                            }
                                            ?>"></i>
                                    </div>
                                    </span>
                                    <span class="namelist"><strong><?php echo $row['danhsach'];?></strong></span>
                                    </div> 
                                <div class="d-flex align-items-center space">
                                <span data-bs-toggle="tooltip" data-bs-placement="left" title="Ngày thực hiện">
                                        <div class="icon-square green text-dark flex-shrink-0 me-3">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                    </span>
                                    <span class="namelist"><strong><?php echo $row['ngayth'];?></strong></span>
                                </div>
                                <div class="d-flex align-items-center space">
                                <span data-bs-toggle="tooltip" data-bs-placement="left" title="Ngày thêm">
                                        <div class="icon-square green text-dark flex-shrink-0 me-3">
                                        <i class="bi bi-calendar-plus"></i>
                                        </div>
                                    </span>
                                    <span class="namelist"><strong><?php echo $row['ngayth'];?></strong></span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        
        <?php
            }
        ?>
       </div>
        </div>
        <div class="col text-decoration-none d-none d-sm-block d-sm-none d-md-block"></div>
    </div>
  </div>
 
</div>
<style>
    .img_null{
        width: 300px;
    }
    .listcolor{
        background-color: #ffff;
        padding: 10px;
        border-radius: 10px;
    }
    .numlist{
        margin-bottom: 3px;
        margin-top: 3px;
        margin-left: 10px;
        margin-right: 10px;
        
    }
    .namelisttop{
        border-right: 1.5px solid #008f63;
        margin-bottom: 3px;
        margin-top: 3px;
        margin-left: 10px;
        padding-right: 10px;
        
    }
    .icon-list{
        border-right: 1.5px solid #008f63;
        margin-bottom: 3px;
        margin-top: 3px;
    }
    .list{
        background-color: #ffff;
        border-radius: 10px;
        margin: 20px;
        border: 1.5px solid;
        border-color: #008f63;
        box-shadow: 0 25px 20px -23px rgba(0, 0, 0, 0.3), 0 0 15px rgba(0, 0, 0, 0.06);

    }
    .list-bar{
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .space{
        margin-top: 5px;
        margin-bottom: 5px;
    }
    
    .moremenu{
        height: 7rem;
        width: 13rem;
    }
    .title{
        margin-bottom: 5px;
        margin-top: 20px;
        margin-left: 20px;
        margin-right: 20px;
        color: #008f63;
        font-size: 1.7rem;
    }
    .task{
        box-shadow: 0 25px 20px -20px rgba(0, 0, 0, 0.3), 0 0 15px rgba(0, 0, 0, 0.06);
        max-width: 40rem;
        min-width: 11rem;
        background-color: #ffff;
        margin: 1.1rem;
        border-top: 8px solid #008f63;
        border-radius: 0!important;
    }
    
.accountinfo{
    padding: 8px;
    background-color: #ffff;
    border-radius: 10px;
}
.img-avt{
    margin-right: 10px;
  border-radius: 10px;
}
a{
    color: #000629;
    text-decoration: none;
}
a:hover {
    color: #027048;
}
/* .topbar{
    background-color: #ffff;
} */
.button-head{
    background-color: #ffff;
    border-radius: 10px;
    margin-right: 15px;
}
.ogange{
    color: #ff7000;
}
.ogange:hover{
    color: #ff7000;
    box-shadow:0 4px 8px rgba(0,0,0,0.2);
}
.red{
    color: #fb3647;
}
.red:hover{
    color: #fb3647;
    box-shadow:0 4px 8px rgba(0,0,0,0.2);
}
.green:hover{
      color: #008f63!important;
      background-color: #ffff!important;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 4px 8px 0 rgba(0, 0, 0, 0.3)!important ;
    }
    .green {
        background-color: #ffff;
    }
    .icon-square {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 1.78rem;
      height: 1.78rem;
      font-size: 1.2rem;
      border-radius: .30rem;
      color: #ffff!important;
      background-color: #fb3647;
      padding: 10px;
    }
    .icon-square:hover {
        color: #ffff!important;
      background-color: #fb3647!important;
      box-shadow: 0 0 0 0!important;
    }
    .namelist{
        font-size: 1rem;
        color: #008f63;
    }
</style>
<?php
}
include 'include/foot.php';
?>
<script>
$(window).on('load',function(){
$(".loader").attr('style', 'display:none');
$(".content").fadeIn(0);
});
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
function myFunction(x) {
  x.classList.toggle("bi-chevron-up");
} 
</script>