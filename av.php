<?php
// Define the endpoint and payload
$url = "https://cloud.appwrite.io/v1";
//$endpoint = 'https://[YOUR_APPWRITE_ENDPOINT]/v1/functions/[FUNCTION_ID]/executions';

$food = $_GET["food"];
$food_id = $_GET["food_id"];
//$appwriteEndpoint = 'http://6735936a3bd3088a3d4b.appwrite.global/';  // Your Appwrite server endpoint
$projectId = '67358cde001a21a5e8e6';            // Your Appwrite Project ID
$apiKey = 'standard_ec179a63d7ca89e0ce605c11592f867e82353ae3024660ad2b385a0d58d7adc3c2113e5cae6da51eeee127def44a9d1503a3d4f75d41f0075972ceb3c6a783fca1b27d51399f4b84e3ac19260d4d36e4c9a0e5e872e5ce7197872447ce3cef6744ff6fc8ad97822905c22838ec457b2d888798f4170dec84700267c58bdba910';                  // Your Appwrite API Key
$functionId = '67359367000f56e4fcba';  

$endpoint = "$url/functions/$functionId/executions";
$data = json_encode([
    'payload' => [
        'text' => 'Sample text to be processed',
        'text_id' => '12345'
    ]
]);

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => [
            'Content-Type: application/json',
            'X-Appwrite-Project: ' . $projectId,
            'X-Appwrite-Key: ' . $apiKey,
        ],
        'content' => $data,
        'ignore_errors' => true  // Helps capture HTTP errors in the response
    ]
];

$context = stream_context_create($options);
$handle = fopen($endpoint, 'r', false, $context);

// Read the response
if ($handle === FALSE) {
    echo "Error in request.";
} else {
    $response = stream_get_contents($handle);
    fclose($handle);
    echo "Response: $response\n";
}
?>
