<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include ('connection.php');

// Prepare and execute the SQL query 
$stmt = $mysqli->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results and store them in an array
$all_users = array();
while ($row = $result->fetch_assoc()) {
    $all_users[] = $row;
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($all_users);
?>
