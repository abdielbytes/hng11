<?php
header('Content-Type: application/json');

// Get the visitor's name from the query parameter
$visitor_name = isset($_GET['visitor_name']) ? htmlspecialchars($_GET['visitor_name']) : 'Guest';

// Get the client's IP address
$client_ip = $_SERVER['REMOTE_ADDR'];

// Get location data from ip-api.com
$location = "Unknown location";
$city = '';
$country = '';
$api_url = "http://ip-api.com/json/{$client_ip}";
$location_data = file_get_contents($api_url);
if ($location_data) {
    $location_data = json_decode($location_data, true);
    if ($location_data['status'] === 'success') {
        $city = $location_data['city'];
        $country = $location_data['country'];
        $location = "{$city}, {$location_data['regionName']}, {$country}";
    }
}

// Fetch weather data from OpenWeatherMap API
$weather = "Unknown weather";
$api_key = 'a86df2f6206389ea1191419f6976c441'; 
if ($city && $country) {
    $weather_url = "http://api.openweathermap.org/data/2.5/weather?q={$city},{$country}&appid={$api_key}&units=metric";
    $weather_data = file_get_contents($weather_url);
    if ($weather_data) {
        $weather_data = json_decode($weather_data, true);
        if ($weather_data['cod'] === 200) {
            $weather_description = $weather_data['weather'][0]['description'];
            $temperature = $weather_data['main']['temp'];
            $weather = "Current weather in {$city}: {$weather_description}, {$temperature}°C";
        }
    }
}

$response = [
    'client_ip' => $client_ip,
    'location' => $location,
    'greeting' => "Hello, $visitor_name! The temperature is {$temperature} degrees Celsius in {$city}.",
];

echo json_encode($response);
?>
