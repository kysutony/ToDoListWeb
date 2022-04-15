<?php
session_start();
error_reporting(0);

$conn = mysqli_connect("localhost","root","","todolist");
// hosst, user, pass, name

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
// if($r_user){
//   echo '<meta http-equiv="refresh" content="0 ;url=index.php">';
//   die();
// }
mysqli_set_charset($conn,"utf8mb4");
date_default_timezone_set('Asia/Ho_Chi_Minh');

$account =  htmlspecialchars($_COOKIE["user"]);

$r_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE account='$account'"));
$agent = $_SERVER["HTTP_USER_AGENT"];

if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
  $browser = "Internet Explorer";
  $time = date("d-m-Y");
  $insert = mysqli_query($conn, "INSERT INTO `count_access`(`user_agent`, `date_agent`) VALUES ('$browser','$time')");

} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
  $browser = "Chrome";
  $time = date("d-m-Y");
  $insert = mysqli_query($conn, "INSERT INTO `count_access`(`user_agent`, `date_agent`) VALUES ('$browser','$time')");
} else if (preg_match('/Edge\/\d+/', $agent) ) {
  $browser =  "Edge";
  $time = date("d-m-Y");
  $insert = mysqli_query($conn, "INSERT INTO `count_access`(`user_agent`, `date_agent`) VALUES ('$browser','$time')");
} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
  $browser =  "Firefox";
  $time = date("d-m-Y");
  $insert = mysqli_query($conn, "INSERT INTO `count_access`(`user_agent`, `date_agent`) VALUES ('$browser','$time')");
} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
  $browser =  "Opera";
  $time = date("d-m-Y");
  $insert = mysqli_query($conn, "INSERT INTO `count_access`(`user_agent`, `date_agent`) VALUES ('$browser','$time')");
} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
  $browser =  "Safari";
  $time = date("d-m-Y");
  $insert = mysqli_query($conn, "INSERT INTO `count_access`(`user_agent`, `date_agent`) VALUES ('$browser','$time')");
}


$session    = session_id();
$time       = time();
$time_check = $time-30; 

$get    = "SELECT * FROM online_user WHERE session='$session'";
$result = mysqli_query($conn, $get);
$count  = mysqli_num_rows($result);
if ($count == "0") { 
  $get1    = "INSERT INTO online_user(session, time)VALUES('$session', '$time')"; 
  $result1 = mysqli_query($conn, $get1);
} else {
  $get2    = "UPDATE online_user(session, time) SET time='$time' WHERE session = '$session'"; 
  $result2 = mysqli_query($conn, $get2); 
}
$sql4    = "DELETE FROM online_user WHERE time<$time_check"; 
$result4 = mysqli_query($conn, $sql4);

?>
