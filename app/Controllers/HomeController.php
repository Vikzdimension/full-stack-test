<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Slider;

use App\Core\View;

class HomeController extends Controller{
    public function index()
    {
        $sliderModel = new Slider();
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

        View::render('Home/index', $data);
    }
}