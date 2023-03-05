<?php
include ('connection.php');

// Prepare and execute the SQL query 
$stmt = $mysqli->prepare("SELECT brand, model, price, processor_type, processor, ram, imgurl, quantity 
FROM laptops join brands on brands.id=laptops.brand_id");
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results and store them in an array
$laptops = array();
while ($row = $result->fetch_assoc()) {
    $laptops[] = $row;
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($laptops);
?>