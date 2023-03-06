<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$laptop_id = $_POST['laptop_id'];

$check_laptop = $mysqli->prepare('select * from laptops where id=?');
$check_laptop->bind_param('i', $laptop_id);
$check_laptop->execute();
$check_laptop->store_result();
$laptop_doesnt_exist = $check_laptop->num_rows();


if ($laptop_doesnt_exist <= 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('Delete from laptops where id=?');
    $query->bind_param('i', $laptop_id);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>