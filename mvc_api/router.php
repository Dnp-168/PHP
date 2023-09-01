<?php
require_once __DIR__ . '/api/controllers/UserController.php';

$requestUri = $_SERVER['REQUEST_URI'];
$baseUri = '/mvc_api';

$route = str_replace($baseUri, '', $requestUri);

$routes = [
    '/login' => 'login'
    // Add more routes here as needed
];


?>
