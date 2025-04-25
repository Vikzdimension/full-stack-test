<?php

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="WPOETS - A simple PHP MVC framework">
    <meta name="keywords" content="PHP, MVC, Framework, WPOETS">
    <meta name="author" content="Vivek Lode">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>
        <?= $title ?? "WPOETS"; ?>
    </title>
</head>

<body class="bg-light">
    <div class="container">
        <h1 class="text-primary"> <?= $message ?? 'Welcome!' ?></h1>
        <p> This is the view rendered using MVC</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>