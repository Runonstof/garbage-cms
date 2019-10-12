<?php
use App\Routes;
use Jenssegers\Blade\Blade;

if(!function_exists('blade')) {
    function blade($blade, $data=[]) {
        $blades = new Blade('./../views', './../cache');

        return $blades->make($blade, $data);
    }
}

if(!function_exists('route')) {
    function route($name) {
        return Routes::getRoutes()->firstWhere('name', $name);
    }
}

if(!function_exists('mix')) {
    function mix($file) {
        return url().'public/'.$file.'?v='.uniqid();
    }
}

if(!function_exists('url')) {
    function url(){
        return sprintf(
          "%s://%s%s",
          isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
          $_SERVER['SERVER_NAME'],
          $_SERVER['REQUEST_URI']
        );
      }
      
}