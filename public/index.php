<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\SliderController;
use App\Core\Database;

try {
    $db = Database::getInstance();

    $uri = $_GET['uri'] ?? 'slider/index';

    $uriParts = explode('/', filter_var($uri, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $controllerName = ucfirst($uriParts[0] ?? 'Slider');
    $method = $uriParts[1] ?? 'index';

    $controllerClass = 'App\\Controllers\\' . $controllerName . 'Controller';

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass($db);

        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            throw new Exception("Method $method not found in $controllerClass");
        }
    } else {
        throw new Exception("Controller class $controllerClass not found");
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>