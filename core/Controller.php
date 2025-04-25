<?php

class Controller
{
    public function model($model)
    {
        $modelPath = "../models/" . $model . ".php";
        if(file_exists($model)){
            require_once $modelPath;
            return new $model;
        }

        throw new Exception("Model file not found: " . $modelPath);
    }

    public function view($view, $data = []){
    {
        $viewPath = ".../models/" . $view . ".php";

        if(file_exists($viewPath)){
            $extract($data);
            require_once $viewPath
        }else{
            throw new Exception("View file not found: " . $viewPath);
        }
    }
}