<?php

if(!function_exists('dd')){
    function dd($data){
        echo '<pre style="background:#222;color:#0f0;padding:10px;border-radius:6px;font-size:14px;">';
        var_dump($data);
        echo "</pre>";
        die();
    }
}