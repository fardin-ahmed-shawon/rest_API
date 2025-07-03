<?php
// Define the API key
define('API_KEY', 'TISFA-API-KEY-7443');

// Validate API key
$headers = getallheaders();
$api_key = $headers['API-Key'] ?? '';

if ($api_key !== API_KEY) {
    $response = array(
        "success" => false,
        "message" => "Invalid API key."
    );
    echo json_encode($response);
    exit();
}