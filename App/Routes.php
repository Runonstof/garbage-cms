<?php
namespace App;

class Routes {
    public static $routes = [];



    public static function match($methods, $url, $controllerMethod) {
        self::$routes[] = [
            'methods' => $methods,
            'url' => $url,
            'controllerMethod' => $controllerMethod
        ];
    }

    public static function get($url, $controllerMethod) {
        self::match(['GET'], $url, $controllerMethod);
    }

    public static function post($url, $controllerMethod) {
        self::match(['POST'], $url, $controllerMethod);
    }

    public static function exec($url) {
        foreach(self::$routes as $route) {

        }
    }


}