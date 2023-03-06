<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$email = $_POST['email'];
$password = $_POST['password'];

$check_admin = $mysqli->prepare('select password from admins where email=?');
$check_admin->bind_param('s', $email);
$check_admin->execute();
$check_admin->store_result();
$admin_doesnt_exist = $check_admin->num_rows();
$check_admin->bind_result($hashed_password);
$check_admin->fetch();


if ($admin_doesnt_exist <= 0) {
    $response['status'] = "failed";
} else {
    if(password_verify($password, $hashed_password)){
        $response['status'] = "success";
    }else{
        $response['status'] = "failed";
    }
}

echo json_encode($response);
?>