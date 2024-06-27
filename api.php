<?php
header('Content-Type: application/json');

// Get the visitor's name from the query parameter
$visitor_name = isset($_GET['visitor_name']) ? htmlspecialchars($_GET['visitor_name']) : 'Guest';

// Get the client's IP address
$client_ip = $_SERVER['REMOTE_ADDR'];


// Get location data from ip-api.com
$location = "Unknown location"; // Default location
$api_url = "http://ip-api.com/json/{$client_ip}";
$location_data = file_get_contents($api_url);
if ($location_data) {
    $location_data = json_decode($location_data, true);
    if ($location_data['status'] === 'success') {
        $location = $location_data['city'] . ', ' . $location_data['regionName'] . ', ' . $location_data['country'];
    }
}

$response = [
    'client_ip' => $client_ip,
    'location'=> $location,
    'greeting' => "Hello, $visitor_name!"
];

echo json_encode($response);
?>
