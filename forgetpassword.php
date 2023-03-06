<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include('connection.php');

$email = $_POST['email'];
$newpassword=$_POST["password"];


$query = $mysqli->prepare('select id from users where email=?');
$query->bind_param('s', $email);
$query->execute();

$query->store_result();
$num_rows = $query->num_rows();
$query->bind_result($id);
$query->fetch();
$response = [];
if ($num_rows == 0) {
    $response['response'] = "email not found";
    
}  else {
    $query = $mysqli->prepare('update users set password=? where email=?');
    $query->bind_param('ss',$newpassword,$email);
    $query->execute();
    $response['status'] = "success";
}
 
echo json_encode($response);
?>