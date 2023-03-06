<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');

$phone_id = $_POST['phone_id'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$price= $_POST["price"];
$amount = $_POST['amount'];
$memory = $_POST['memory'];
$imgurl = $_POST['imgurl'];

$check_phone = $mysqli->prepare('select id from phones where id=?');
$check_phone->bind_param('i', $phone_id);
$check_phone->execute();
$check_phone->store_result();
$phone_doesnt_exist = $check_phone->num_rows();

if ($phone_doesnt_exist <= 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('update phones set brand_id=?, model=?, price=?, amount=?, memory=?, imgurl=? where id=?');
    $query->bind_param('isiiisi', $brand, $model, $price, $amount, $memory, $imgurl, $phone_id);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>