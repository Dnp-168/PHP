<?php
require_once __DIR__ . '/router.php';

if (isset($routes[$route])) {
    require_once __DIR__ . '/config.php'; // Include database configuration

    $controller = new UserController($conn);
    $method = $routes[$route];
    $controller->$method();
} else {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found';
}
?>






