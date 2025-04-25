<?php

namespace App\Core;

require_once __DIR__ . '/../helpers/helpers.php';

class Controller
{
    public function model($model)
    {
        $modelName = 'App\\Models\\' . $model;
        
        if (class_exists($modelName)) {
            return new $modelName;
        }

        throw new \Exception("Model class not found: " . $modelName);
    }
    
    public function view($view, $data = [])
    {
        $view_path = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($view_path)) {
            extract($data, EXTR_SKIP);
            require_once $view_path;
        } else {
            throw new \Exception("View file not found: " . $view_path);
        }
    }
    
}