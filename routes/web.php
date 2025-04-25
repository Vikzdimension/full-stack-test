<?php

use App\Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/sliders', 'SliderController@index');
$router->get('/sliders/edit/{id}', 'SliderController@edit');
$router->post('/sliders/edit/{id}', 'SliderController@update');
$router->post('/sliders/delete/{id}', 'SliderController@delete');
$router->get('/sliders/create', 'SliderController@create');
$router->post('/sliders/create', 'SliderController@store');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);