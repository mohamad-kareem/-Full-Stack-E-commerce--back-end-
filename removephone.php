<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$phone_id = $_POST['phone_id'];

$check_phone = $mysqli->prepare('select * from phones where id=?');
$check_phone->bind_param('i', $phone_id);
$check_phone->execute();
$check_phone->store_result();
$phone_doesnt_exist = $check_phone->num_rows();


if ($phone_doesnt_exist <= 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('Delete from phones where id=?');
    $query->bind_param('i', $phone_id);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>