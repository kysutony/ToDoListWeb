<?php
include 'model/config.php';
if($_SERVER['PHP_SELF'] == "/index.php"){
    $act = "navbactive";
  }elseif($_SERVER['PHP_SELF'] == "/list.php"){
    $act1 = "navbactive";
  }elseif($_SERVER['PHP_SELF'] == "/systemlist.php"){
    $act1 = "navbactive";
  }elseif($_SERVER['PHP_SELF'] =="/todo.php"){
    $act1 = "navbactive";
  }elseif($_SERVER['PHP_SELF'] =="/done.php"){
    $act1 = "navbactive";
  }elseif($_SERVER['PHP_SELF'] =="/statistic.php"){
    $act2 = "navbactive";
  }elseif($_SERVER['PHP_SELF'] =="/account.php"){
    $act3 = "navbactive";
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/signin.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="http://demos.codexworld.com/includes/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
     <link rel="icon" 
     type="image/png" 
     href="http://2dolist.website/asset/Icon.png">
    <title>Todolist</title>
  
</head>
<style>
.content{
    display: none;
}
.loader{
    height: 100vh;
    width: 100vw;
    overflow: hidden;
    background-color: #f0f0f0;
    position: static;
}
.loader>div {
    height: 100px;
    width: 100px;
    border: 15px solid #fdc324;
    border-top-color: #ff7000;
    position: absolute;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    border-radius: 50%;
    animation: spin 1.5s infinite linear;
    
}
@keyframes spin{
    100%{
        transform: rotate(360deg);
    }
    
}
  body{
    background-color: #f0f0f0;
    margin-top: 0px;
    }
    .container{
        margin-top: 35px;
    }
    .navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
    color: #008f63 !important;
    }
    .navbar-light .navbar-nav .show > .nav-link, .navbar-light .navbar-nav .nav-link.active{
      color: #008f63 !important;
    }
    .tabbutton{
      border-radius: 30px;
      padding: 1px;
      box-sizing: content-box; 
      background-color: #e0e0e0!important;
      width: auto;
      justify-content: center!important;
    }
    .buttontab{
      border-radius: 50px;
      margin: 5px;
      color: #8e8e93!important;
      padding-left: 18px;
      padding-right: 18px;
      border: none;
    }
    .buttontab:not(.nohover):hover{
      color: none;
    }
    .buttontab.active{
      color: #ff7000!important;
      background-color: #f2f2f2!important;
    }
    .singlebutton{
      padding: .375rem .75rem;
      /* border-radius: 15px; */
      background-color: #008f63;
      border: none;
      color: #fff;
      width: auto!important;
    }
    .singlebutton:hover{
      color: #fff;
      background-color: #027048;
      box-shadow: 0 25px 20px -30px rgba(0, 0, 0, 0.3), 0 0 15px rgba(0, 0, 0, 0.06);
    }
    .alert-color{
      color: #8e8e93;
      background-color: #fff;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 4px 8px 0 rgba(0, 0, 0, 0.01), ;
      
    }
    .buttonlogin{
      background-color: #b5d8c9;

      padding: .375rem .75rem;
      color: #008f63;
      
    }
    .buttonlogin:hover{
      color: #008f63;
      background-color: #b5d8c9;
      box-shadow: 0 25px 20px -30px rgba(0, 0, 0, 0.3), 0 0 15px rgba(0, 0, 0, 0.06);
    }
    .navbactive{
        opacity: 1.0!important;
      border-top: 5px solid #008f63!important;
      -webkit-filter: none!important; /* Safari 6.0 - 9.0 */
      filter: none!important;
    }
    .linetab{
      opacity: 0.5;
      border-top: 5px solid #ffff;
      -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
      filter: grayscale(100%);
    }
    .button-login{
      padding: .375rem .75rem;
      color: #8e8e93;
      background-color: #008f63;
      border: none;
      color: #fff;
    }
    .button-login:hover{
      color: #fff;
      background-color: #027048;
    }
    .space{
      margin-top: 10px;
    }
    .list-group {
      width: auto;
      max-width: 1100px;
      margin: 4rem auto;
      }
    .mini-btn{
      padding: .375rem .75rem;
      border-radius: 15px;
      background-color: #008f63;
      border: none;
      color: #fff;
      }
    .card-pin{
      background-color: #fff;
      border-radius: 25px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 4px 8px 0 rgba(0, 0, 0, 0.1) ; 
      margin: 10px;
      }
    .card-title{
      color: #ff7000;
      }
    .btn-check:focus + .btn, .btn:focus {
      outline: 0;
      box-shadow: 0 0 0 0;
}
    .tooltip-inner {
      background-color: white !important; /* Set box color to red */
      color: black !important; /* Set text color to black */
      box-shadow:0 4px 8px rgba(0,0,0,0.2);
}
    .tooltip.bs-tooltip-top .tooltip-arrow::before {
      border-top-color: white; /* Set arrow color to red */
      box-shadow:0 4px 8px rgba(0,0,0,0.2);
}

    .tooltip.bs-tooltip-bottom .tooltip-arrow::before {
      border-bottom-color: white; /* Set arrow color to red */
      box-shadow:0 4px 8px rgba(0,0,0,0.2);
}
    .tooltip.bs-tooltip-start .tooltip-arrow::before {
      border-left-color: white; /* Set arrow color to red */
      box-shadow:0 4px 8px rgba(0,0,0,0.2);
}

  .tooltip.bs-tooltip-end .tooltip-arrow::before {
    border-right-color: white; /* Set arrow color to red */
    box-shadow:0 4px 8px rgba(0,0,0,0.2);
}
  .form-control:focus {
    border-color: #b5d8c9;
    box-shadow: 0 0 0 .25rem #b5d8c9;
}
  .title-head{
    color: #008f63;
    font-size: 2rem;
    font-weight: 800;
}
  .icon-head{
    width: 30px;
  }
  .button-head{
    font-size: 1.2rem;
  }
  .admintitle{
    
    color: #ff7000;
  }
  a{
    color: #000629;
    text-decoration: none;
  }
</style>
<body>
    <div class="container">
  <!---HEADER--->
    <header class="d-flex flex-wrap fixed-bottom align-items-center justify-content-center " style="background:white;padding:5px">
    
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none d-none d-sm-block d-sm-none d-md-block">
      <img src="asset/Logo2.png" width="160px">
      </a>
      <?php 
        if(empty($_COOKIE["adminpermission"]) && empty($_COOKIE["userpermission"])){
 
      ?>

        <div class="col-md-3 text-end">
        <button type="button" class="btn buttonlogin me-2" onclick="location.href='login.php'">Đăng nhập</button>
        <button type="button" class="btn singlebutton" onclick="location.href='signup.php'">Đăng ký</button>
      
      <?php }else{ ?>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li class="linetab <?=$act?>">
          <a href="index.php" class="nav-link px-2 link-dark ">
            <center> <img src="asset/tabbar/trangchu.png" width="30px" style="display: block;"> Trang Chủ</center>
            </a></li> 
            <li class="linetab <?=$act1?>">
              <a href="list.php" class="nav-link px-2 link-dark">
              <center>  <img src="asset/tabbar/congviec.png" width="30px" style="display: block;"> Công Việc</center>
            </a>
            </li>

            <li class="linetab <?=$act2?>">
              <a href="statistic.php" class="nav-link px-2 link-dark">
            <center>  <img src="asset/tabbar/thongke.png" width="30px" style="display: block;"> Thống Kê</center>
            </a>
          </li> 

            <li class="linetab <?=$act3?>">
              <a href="account.php" class="nav-link px-2 link-dark">
            <center>  <img src="asset/tabbar/taikhoan.png" width="30px" style="display: block;"> Tài Khoản</center>
            </a>
          </li> 

      </ul>
      <div class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none d-none d-sm-block d-sm-none d-md-block text-end">
        <?php
         if(empty($_COOKIE["adminpermission"])){

        }else{
        ?>
        <a href="admin/">
        <!--<h3 class="admintitle"><i class="bi bi-person-plus-fill"></i> Admin</h3>-->
        <img src="asset/Logoadmin.png" width="160px">
        </a>
        <?php
       }
      }
       ?>
      </div>
    </header>



 