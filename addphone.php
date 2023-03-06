<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$brand = $_POST['brand'];
$model = $_POST['model'];
$price= $_POST["price"];
$amount = $_POST['amount'];
$memory = $_POST['memory'];
$imgurl = $_POST['imgurl'];



$check_phone = $mysqli->prepare('select model from phones where model=?');
$check_phone->bind_param('s', $model);
$check_phone->execute();
$check_phone->store_result();
$phone_exists = $check_phone->num_rows();

if ($phone_exists > 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('insert into phones(brand_id,model,price,amount,memory,imgurl) values(?,?,?,?,?,?)');
    $query->bind_param('isiiis', $brand, $model, $price, $amount, $memory, $imgurl);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>