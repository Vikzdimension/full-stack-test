<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routes/web.php';

use App\Core\Database;
use App\Models\Slider;

try {
    $db = Database::getInstance();

    $sliderModel = new Slider($db);

    $sliderModel->insertDefaultSliders();

    $sliders = $sliderModel->getAllSliders();

    if (empty($sliders)) {
        $message = 'No sliders available';
    } else {
        $message = 'Here are the available sliders';
    }

    $data = [
        'message' => $message,
        'sliders' => $sliders,
    ];

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>