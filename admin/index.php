<?php
include 'include/head.php';
if(empty($_COOKIE["adminpermission"])){
     echo '<script>window.location.href="../login.php";</script>';

}else{
  // ĐẾM NGỪOI DÙNG ONLINE
    $get3              = "SELECT * FROM online_user";
    $result3           = mysqli_query($conn, $get3); 
    $count_user_online = mysqli_num_rows($result3);
  // ĐẾM TỔNG NGƯỜI DÙNG
    $getuser = "SELECT * FROM `user`";
    $resultuser = mysqli_query($conn, $getuser);
    $countuser = mysqli_num_rows($resultuser);
  // ĐẾM TỔNG DANH SÁCH
    $getlist = "SELECT * FROM `danhsach`";
    $resultlist = mysqli_query($conn, $getlist);
    $countlist = mysqli_num_rows($resultlist);
  // ĐẾM TỔNG NHIỆM VỤ 
    $gettodo = "SELECT * FROM `nhiemvu`";
    $resulttodo = mysqli_query($conn, $gettodo);
    $counttodo = mysqli_num_rows($resulttodo);
  // ĐẾM TỔNG NHIỆM VỤ GHIM
    $gettodopin = "SELECT * FROM `nhiemvu` WHERE `pin` = 1";
    $resulttodopin = mysqli_query($conn, $gettodopin);
    $counttodopin = mysqli_num_rows($resulttodopin);
  // ĐẾM TỔNG NHIỆM VỤ HOÀN THÀNH
    $gettododone = "SELECT * FROM `nhiemvu` WHERE `checklist` = 1";
    $resulttododone = mysqli_query($conn, $gettododone);
    $counttododone = mysqli_num_rows($resulttododone);
  // ĐẾM TỔNG NHIỆM VỤ CHƯA HOÀN THÀNH 
    $gettodo_notdone = "SELECT * FROM `nhiemvu` WHERE `checklist` = 0";
    $resulttodo_notdone = mysqli_query($conn, $gettodo_notdone);
    $counttodo_notdone = mysqli_num_rows($resulttodo_notdone);
  
?>
<style>
  .table-text-end{
        width: 100px;
      }
</style>

<div class="row">
<div class="col">
  <div class="title">
    <div class="nametitle">
        <h3><span class="name">Trang Thống Kê</span></h3>
    </div>
    <div class="distitle">
          <p>Đây là trang thống kê tất cả số liệu của trang Todolist và ứng dụng trên iOS</p>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col"></div>
    <div class="col-8">
    <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><h5><span class="justify-content-left">Tổng lượng truy cập</span></h5></th>
                    <th scope="col" class="table-text-end"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><span class="d-flex justify-content-left"><i class="bi bi-inboxes-fill text-muted small ms-1"></i><span class="nametb">Tất cả</span></span></span></th>
                    
                    <td class="table-text-end justify-content-left">
                    <div class="d-flex justify-content-center">
                      <span class="badge "><?php $show = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `count_access` WHERE date_agent"));
                      echo $show;?></span>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <th scope="row"><span class="d-flex justify-content-left"><i class="bi bi-calendar-day text-muted small ms-1"></i><span class="nametb">Theo tuần</span></span></span> </th>
                    
                    <td class="table-text-end">
                    <div class="d-flex justify-content-center">
                      <span class="badge "><?php 
                      $now = date("d-m-Y");
                      $dayago = date('d-m-Y', strtotime($now. ' -7 days'));                      
                      $show = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `count_access` WHERE date_agent BETWEEN '$dayago' AND '$now'"));
                      echo $show;
                      ?></span>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <th scope="row"><span class="d-flex justify-content-left"><i class="bi bi-calendar-date text-muted small ms-1"></i><span class="nametb">Theo tháng</span></span></span></th>
                    
                    <td class="table-text-end">
                    <div class="d-flex justify-content-center">
                      <span class="badge "><?php 
                       $now = date("d-m-Y");
                      $dayago = date('d-m-Y', strtotime($now. ' -30 days'));                      
                      $show = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `count_access` WHERE date_agent BETWEEN '$dayago' AND '$now'"));
                      echo $show;
                      ?></span>
                      </div>
                    </td>
                  </tr>

                </tbody>
              </table>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><h5><span class="justify-content-left">Tổng người trực tuyến</span></h5></th>
                    <th scope="col" class="table-text-end"></th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><span class="d-flex align-items-center"><i class="fas fa-user-clock text-muted small ms-1"></i><span class="nametb">Tất cả</span></span></span></th>
                    
                    <td class="table-text-end">
                      <div class="d-flex justify-content-center">
                      <span class="badge"><?=$count_user_online?></span>
                      </div>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><h5><span class="justify-content-left">Tổng số người dùng</span></h5></th>
                    <th scope="col" class="table-text-end">
                    <div class="d-flex justify-content-center">
                    <a href="user.php"><i class="bi-info-circle text-muted small ms-1"></i></a>
                    </div>
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><span class="d-flex align-items-center"><i class="fas fa-users text-muted small ms-1"></i><span class="nametb">Tất cả</span></span></span></th>
                    
                    <td class="table-text-end">
                      <div class="d-flex justify-content-center">
                      <span class="badge"><?=$countuser?></span>
                      </div>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><h5><span class="justify-content-left">Tổng số chuyên mục</span></h5></th>
                    <th scope="col" class="table-text-end">
                    <div class="d-flex justify-content-center">
                    <a href="list.php"><i class="bi-info-circle text-muted small ms-1"></i></a>
                    </div>
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><span class="d-flex align-items-center"><i class="fas fa-bars text-muted small ms-1"></i><span class="nametb">Tất cả</span></span></span></th>
                    
                    <td class="table-text-end">
                      <div class="d-flex justify-content-center">
                      <span class="badge"><?=$countlist?></span>
                      </div>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><h5><span class="justify-content-left">Tổng số nhiệm vụ</span></h5></th>
                    <th scope="col" class="table-text-end">
                    <div class="d-flex justify-content-center">
                    <a href="todo.php"><i class="bi-info-circle text-muted small ms-1"></i></a>
                    </div>
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><span class="d-flex align-items-center"><i class="fas fa-check-double text-muted small ms-1"></i><span class="nametb">Tất cả</span></span></span></th>
                    
                    <td class="table-text-end">
                      <div class="d-flex justify-content-center">
                      <span class="badge"><?=$counttodo?></span>
                      </div>
                    </td>
                  </tr>
                  
                  <tr>
                    <th scope="row"><span class="d-flex align-items-center"><i class="bi bi-pin-angle-fill text-muted small ms-1"></i><span class="nametb">Nhiệm vụ ghim</span></span></span></th>
                    
                    <td class="table-text-end">
                      <div class="d-flex justify-content-center">
                      <span class="badge"><?=$counttodopin?></span>
                      </div>
                    </td>
                  </tr>
                  
                  <tr>
                    <th scope="row"><span class="d-flex align-items-center"><i class="bi bi-check-circle-fill text-muted small ms-1"></i><span class="nametb">Nhiệm vụ hoàn thành</span></span></span></th>
                    
                    <td class="table-text-end">
                      <div class="d-flex justify-content-center">
                      <span class="badge"><?=$counttododone?></span>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <th scope="row"><span class="d-flex align-items-center"><i class="bi bi-exclamation-circle-fill text-muted small ms-1"></i><span class="nametb">Nhiệm vụ chưa hoàn thành</span></span></span></th>
                    
                    <td class="table-text-end">
                      <div class="d-flex justify-content-center">
                      <span class="badge "><?=$counttodo_notdone?></span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
    </div>
    <div class="col"></div>
  </div>

<?php
}
include 'include/foot.php';