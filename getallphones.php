<?php
include ('connection.php');

// Prepare and execute the SQL query 
$stmt = $mysqli->prepare("SELECT brand, model, price, memory, imgurl, amount FROM phones join brands on brands.id=phones.brand_id");
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results and store them in an array
$phones = array();
while ($row = $result->fetch_assoc()) {
    $phones[] = $row;
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($phones);
?>