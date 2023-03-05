<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = $mysqli->prepare('select id,fname,lname,email,password from users where email=?');
$query->bind_param('s', $email);
$query->execute();

$query->store_result();
$num_rows = $query->num_rows();
$query->bind_result($id, $fname,$lname,$email,$hashed_password);
$query->fetch();
$response = [];
if ($num_rows == 0) {
    $response['response'] = "email not found";
    
} else {
    if (password_verify($password, $hashed_password)) {
        $response['response'] = "logged in";
        $response['id'] = $id;
        $response['fname'] = $fname;
        $response['lname'] = $lname;
        $response['email'] = $email;
    } else {
     $response["response"] = "Incorrect password";
    }
}

echo json_encode($response);
