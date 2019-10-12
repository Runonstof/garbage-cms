<?php
namespace App;

use App\Route;

class Routes {
    public static $routes = [];



    public static function match($methods, $url, $controllerMethod) {
        $newRoute = new Route($methods, $url, $controllerMethod);

        self::$routes[] = $newRoute;

        return $newRoute;
    }

    public static function get($url, $controllerMethod) {
        return self::match(['GET'], $url, $controllerMethod);
    }

    public static function post($url, $controllerMethod) {
        return self::match(['POST'], $url, $controllerMethod);
    }

    public static function exec($url) {
        
        foreach(self::$routes as $route) {
            $vars = [];
            if($route->match($url, $vars)) {
                $route->exec($vars);
            }
        }
    }

    public static function getRoutes() {
        return collect(self::$routes);
    }


}