<?php

require_once __DIR__ . '/../config/database.php';

echo "DB Connection Successful!";

$uri = $_GET['uri'] ?? 'slider/index';

require_once __DIR__ . '/../controllers/SliderController.php';

[$controllerName, $method] = explode('/', $uri);
// var_dump($controllerName, $method);

$controllerName = ucfirst($controllerName) . 'Controller';
// var_dump($controllerName, $method);


$controller = new $controllerName();
// var_dump($method);

$controller->$method();

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
        <h1 class="text-primary"> <?= $message ?></h1>

        <p> This is the view rendered using MVC</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>