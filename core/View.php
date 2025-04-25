<?php

class View{
    public function render($view, $data = []){
        $view_path = "../views/" . $view. ".php";

        if(file_exists($view_path)){
            extract($data);
            require_once $view_path;
        }else{
            throw new Exception("View file not found: " . $view_path);
        }
    }
}