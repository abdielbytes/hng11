<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Gather client API details
$client_ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Prepare the response
$response = [
    "message" => "Hello Mark",
    "client_ip" => $client_ip,
    "user_agent" => $user_agent
];

// Send the JSON response
echo json_encode($response);
?>
