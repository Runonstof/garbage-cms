<?php
namespace App;

use App\Route;

class Routes {
    public static $routes = [];
    public static $fallbackRoute = null;



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

    public static function fallback($controllerMethod) {
        self::$fallbackRoute = new Route(['POST', 'GET'],'', $controllerMethod);
    }

    public static function exec($url) {
        $found = false;
        foreach(self::$routes as $route) {
            $vars = [];
            if($route->match($url, $vars)) {
                $found=true;
                $route->exec($vars);
                break;
            }
        }

        if(!$found) {
            if(!is_null(self::$fallbackRoute)) {
                self::$fallbackRoute->exec();
            }
        }
    }

    public static function getRoutes() {
        return collect(self::$routes);
    }


}