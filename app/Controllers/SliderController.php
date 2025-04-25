<?php

namespace App\Controllers;

use App\Models\Slider;
use App\Core\View;

class SliderController
{
    private $sliderModel;

    public function __construct()
    {
        $this->sliderModel = new Slider();
    }

    public function index()
    {
        $this->sliderModel->insertDefaultSliders();

        $sliders = $this->sliderModel->getAllSliders();

        if (empty($sliders)) {
            $message = 'No sliders available';
        } else {
            $message = 'Here are the available sliders';
        }

        $data = [
            'message' => $message,
            'sliders' => $sliders,
        ];

        View::render('sliders/index', $data);
    }
}