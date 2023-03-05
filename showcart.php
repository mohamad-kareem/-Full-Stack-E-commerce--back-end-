<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
include ('connection.php');

// Prepare and execute the SQL query 
$stmt = $mysqli->prepare("SELECT brand, model, price, imgurl FROM phones join carts on phones.brand_id=carts.brand_id
join brands ON brands.id=phones.brand_id
WHERE carts.id=?
UNION 
SELECT  brand, model, price, imgurl FROM laptops join carts on laptops.brand_id=carts.brand_id
join brands ON brands.id=laptops.brand_id
WHERE carts.id=?");
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results and store them in an array
$items = array();
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($items);
?>