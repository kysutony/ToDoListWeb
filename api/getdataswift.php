<?php
include '../model/config.php';
$result = mysqli_query($conn,"SELECT * FROM nhiemvu");

$data = array();
while ($row = mysqli_fetch_object($result)){

array_push($data,$row);
}
echo json_encode($data);



?>