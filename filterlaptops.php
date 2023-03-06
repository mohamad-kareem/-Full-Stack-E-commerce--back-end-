<?php
include ('connection.php');


$selectedBrand = $_GET['brand'];
$selectedPriceMax = $_GET['pricemax'];


// Prepare and execute the SQL query based on the selected brands and price range
$stmt = $mysqli->prepare("SELECT brand, model, price, imgurl FROM laptops join brands WHERE brand = ? AND price <= ?");
$stmt->bind_param("si", $selectedBrand, $selectedPriceMax);

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

