<?php
include ('connection.php');

$user_id = $_GET['userid'];
$laptop_id = $_GET['laptopid'];

// Prepare and execute the SQL query 
$stmt = $mysqli->prepare("INSERT INTO carts (user_id, laptop_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $laptop_id);

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