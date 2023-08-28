<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['url'])) {
    $url = rtrim($_GET['url'], '/');
    $url = explode('/', $url);

    $controllerName = ucfirst($url[0]) . 'Controller';
    $actionName = isset($url[1]) ? $url[1] : 'index';

    require_once 'core/Database.php';

    if (file_exists('api/controllers/' . $controllerName . '.php')) {
        require_once 'api/controllers/' . $controllerName . '.php';

        $controller = new $controllerName();

        if (method_exists($controller, $actionName)) {
            // Call the controller's action method with any additional URL parameters
            $params = array_slice($url, 2);
            call_user_func_array(array($controller, $actionName), $params);
        } else {
            echo 'Action not found.';
        }
    } else {
        echo 'Controller not found.';
    }
} else {
    echo 'Invalid URL.';
}
?>