<?php
// URL to make the POST request
$food_id = $_GET["food_id"];
$food = $_GET["food"];
$url = "https://6735936a3bd3088a3d4b.appwrite.global/";

// Data to be sent in the POST request
$data = array(
    "food_id" => $food_id,
    "food" => $food
);

// Initialize cURL session
$ch = curl_init($url);

// Configure cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute cURL session and store response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    echo 'Response: ' . $response;
}

// Close cURL session
curl_close($ch);
?>
