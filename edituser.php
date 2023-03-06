<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_address=$_POST["email"];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];


$check_email = $mysqli->prepare('select email from users where email=?');
$check_email->bind_param('s', $email_address);
$check_email->execute();
$check_email->store_result();
$email_doesnt_exists = $check_email->num_rows();

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

if ($email_doesnt_exists <= 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('update users set fname=?, lname=?, password=?, phone=?, address=? where email=?');
    $query->bind_param('ssssis', $first_name, $last_name, $hashed_password, $phone, $address, $email_address);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>