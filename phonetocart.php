<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include ('connection.php');

$user_id = $_GET['userid'];
$phone_id = $_GET['phoneid'];

// Prepare and execute the SQL query 
$stmt = $mysqli->prepare("INSERT INTO carts (user_id, phone_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $phone_id);

if ($stmt->execute()) {
    // Get the number of rows affected by the INSERT statement
    $rows_affected = $mysqli->affected_rows;

    if ($rows_affected > 0) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }
} else {
    $response['status'] = false;
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>