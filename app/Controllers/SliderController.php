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

    public function create()
    {
        View::render('sliders/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            $image = $this->handleImageUpload();

            $data = [
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'image' => $image,
            ];

            $this->sliderModel->insertSlider($data);

            header("Location: /sliders?message=Slider created successfully");
            exit;
        }
    }

    public function edit($id)
    {
        $slider = $this->sliderModel->getSliderById($id);

        if (!$slider) {
            echo "Slider with ID $id not found!";
            return;
        }

        $data = [
            'slider' => $slider,
        ];

        View::render('sliders/edit', $data);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            $image = $this->handleImageUpload($id);

            $data = [
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'image' => $image,
            ];

            $this->sliderModel->updateSlider($id, $data);

            header("Location: /sliders?message=Slider updated successfully");
            exit;
        }

        $slider = $this->sliderModel->getSliderById($id);

        if (!$slider) {
            echo "Slider with ID $id not found!";
            return;
        }

        $data = [
            'slider' => $slider,
        ];

        View::render('sliders/edit', $data);
    }

    private function handleImageUpload($sliderId = null)
    {
        $image = null;

        if (!empty($_FILES['image']['name'])) {
            if ($sliderId) {
                $old = $this->sliderModel->getSliderById($sliderId);
                if ($old && file_exists(__DIR__ . '/../files/images/' . $old['image'])) {
                    unlink(__DIR__ . '/../files/images/' . $old['image']);
                }
            }

            $image = basename($_FILES['image']['name']);
            $uploadDir = __DIR__ . '/../../public/files/images/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
        } else {
            if ($sliderId) {
                $image = $this->sliderModel->getSliderImage($sliderId);
            }
        }

        return $image;
    }

    public function delete($id)
    {
        $slider = $this->sliderModel->getSliderById($id);
        if (!$slider) {
            echo "Slider with ID $id not found!";
            return;
        }

        $this->sliderModel->deleteSlider($id);

        header("Location: /sliders");
        exit;
    }
}