<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$user_id = $_POST['user_id'];

$check_user = $mysqli->prepare('select * from users where id=?');
$check_user->bind_param('i', $user_id);
$check_user->execute();
$check_user->store_result();
$user_doesnt_exist = $check_user->num_rows();


if ($user_doesnt_exist <= 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('Delete from users where id=?');
    $query->bind_param('i', $user_id);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>