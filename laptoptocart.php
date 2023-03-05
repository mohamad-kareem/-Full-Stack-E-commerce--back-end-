<?php
include ('connection.php');

$user_id = $_GET['userid'];
$laptop_id = $_GET['laptopid'];

// Prepare and execute the SQL query 
$stmt = $mysqli->prepare("INSERT user_id, laptop_id INTO carts");
$stmt->bind_param("ii", $user_id, $laptop_id);

$stmt->execute();
$result = $stmt->get_result();

// Fetch the results and store them in an array
$r = array();
while ($row = $result->fetch_assoc()) {
    $r[] = $row;
}
if ($r > 0) {
    $response['status'] = True;
} else {
    $response['status'] = False;
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>