<?php
use Jenssegers\Blade\Blade;

if(!function_exists('blade')) {

    function blade($blade, $data=[]) {
        $blades = new Blade('./../views', './../cache');

        return $blades->make($blade, $data);
    }
}