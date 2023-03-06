<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$laptop_id = $_POST['laptop_id'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$price= $_POST["price"];
$amount = $_POST['amount'];
$vga = $_POST['vga'];
$processor_type = $_POST['processor_type'];
$processor = $_POST['processor'];
$ram = $_POST['ram'];
$imgurl = $_POST['imgurl'];



$check_laptop = $mysqli->prepare('select id from laptops where id=?');
$check_laptop->bind_param('s', $laptop_id);
$check_laptop->execute();
$check_laptop->store_result();
$laptop_doesnt_exist = $check_laptop->num_rows();

if ($laptop_doesnt_exist <= 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('update laptops set brand_id=?, model=?, price=?, quantity=?, vga=?, processor_type=?, processor=?, ram=?, imgurl=? where id=?');
    $query->bind_param('isiisssssi', $brand, $model, $price, $amount, $vga, $processor_type, $processor, $ram, $imgurl, $laptop_id);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>