<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../../model/conn.php';
include '../../model/data.php';
$db = new DB();
$connect = $db->connect();

$user = new User($connect);
$read = $user->read();

$num = $read->rowCount();
if($num>0){
    $user_array = [];
    $user_array['User'] = [];
    while ($row = $read->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $user_item = array(
            'id' =>$id,
            'account' =>$account,
            'pass'=> $pass
        );
    array_push($user_array['User'],$user_item);
    }
    echo json_encode($user_array);
}