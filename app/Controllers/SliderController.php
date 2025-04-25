<?php

namespace App\Controllers;

use App\Models\Slider;
use App\Core\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $sliderModel = new Slider();
        $sliders = $sliderModel->getAllSliders();

        if (empty($sliders)) {
            $message = 'No sliders available';
        } else {
            $message = 'Here are the available sliders';
        }

        $data = [
            'message' => $message,
            'sliders' => $sliders
        ];

        $this->view('sliders/index', $data);
    }
}