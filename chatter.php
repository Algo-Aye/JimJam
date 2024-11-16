<?php
// URL to make the POST request
$food_id = json_decode(file_get_contents('php://input'), true)["message"];
//$food = $_GET["food"];
$url = "https://673591573d18cb60cdda.appwrite.global/";

// Data to be sent in the POST request
$data = array(
    "message" => $food_id,
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

//$json_response = json_decode($response);
$food_response = $response;//$json_response[0]->metadata->title;
// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    echo $food_response;
}

// Close cURL session
curl_close($ch);
?>
