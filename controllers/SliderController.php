<?php


require_once __DIR__ . '/../core/Controller.php';

class SliderController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Slider Page',
            'message' => 'Welcome to Slider Index!'
        ];
        $this->view('sliders/index', ['sliders' => $data]);
    }

}