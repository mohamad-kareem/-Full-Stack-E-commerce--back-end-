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
$email_exists = $check_email->num_rows();

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

if ($email_exists > 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('insert into users(fname,lname,email,password,phone,address) values(?,?,?,?,?,?)');
    $query->bind_param('ssssis', $first_name, $last_name, $email_address, $hashed_password, $phone, $address);
    $query->execute();
    $response['status'] = "success";
}

echo json_encode($response);
?>