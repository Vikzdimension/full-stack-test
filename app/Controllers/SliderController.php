<?php

namespace App\Controllers;

use App\Core\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $data = ['message' => 'Welcome to the Slider page!'];
        $this->view('sliders/index', $data);
    }
}