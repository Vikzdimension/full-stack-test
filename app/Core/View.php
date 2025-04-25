<?php

namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewPath)) {
            extract($data, EXTR_SKIP);
            require $viewPath;
        } else {
            throw new \Exception("View file not found: {$viewPath}");
        }
    }
}