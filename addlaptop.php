<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$brand = $_POST['brand'];
$model = $_POST['model'];
$price= $_POST["price"];
$amount = $_POST['amount'];
$vga = $_POST['vga'];
$processor_type = $_POST['processor_type'];
$processor = $_POST['processor'];
$ram = $_POST['ram'];
$imgurl = $_POST['imgurl'];



$check_laptop = $mysqli->prepare('select model from laptops where model=?');
$check_laptop->bind_param('s', $model);
$check_laptop->execute();
$check_laptop->store_result();
$laptop_exists = $check_laptop->num_rows();

if ($laptop_exists > 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('insert into laptops(brand_id, model, price, quantity, vga, processor_type, processor, ram, imgurl) values(?,?,?,?,?,?,?,?,?)');
    $query->bind_param('isiisssss', $brand, $model, $price, $amount, $vga, $processor_type, $processor, $ram, $imgurl);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>