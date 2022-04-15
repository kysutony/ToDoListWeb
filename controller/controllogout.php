<?php
include '../model/config.php';
    setcookie("user", "", time() - (86400 * 30) ,('/')); 
    setcookie("pass", "", time() - (86400 * 30) ,('/'));   
    setcookie("userpermission", "", time() - (86400 * 30) ,('/'));   
    setcookie("adminpermission", "", time() - (86400 * 30) ,('/'));   

    $sql4    = "DELETE FROM online_user WHERE time"; 
    mysqli_query($conn, $sql4);
    echo '<script>window.location.href="https://2dolist.website/index.php";</script>';
?>