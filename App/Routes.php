<?php
namespace App;

use App\Route;

/**
 * Route handler, something based on Laravel I wanted to try to make myself
 */
class Routes {
    public static $routes = [];
    public static $fallbackRoute = null; //When URL doesnt match any route it uses this fallback route

    
    /**
     * Adds a route that accepts multiple request methods
     *
     * @param Array $methods
     * @param String $url
     * @param String|Callable $controllerMethod
     * @return App\Route
     */
    public static function match(Array $methods, String $url, $controllerMethod) {
        $newRoute = new Route($methods, $url, $controllerMethod);

        self::$routes[] = $newRoute;

        return $newRoute;
    }

    /**
     * Adds a route that accepts only requests via the GET method
     *
     * @param String $url
     * @param String|Callable $controllerMethod
     * @return App\Route
     */
    public static function get($url, $controllerMethod) {
        return self::match(['GET'], $url, $controllerMethod);
    }

    /**
     * Adds a route that accepts only requests via the POST method
     *
     * @param String $url
     * @param String|Callable $controllerMethod
     * @return App\Route
     */
    public static function post($url, $controllerMethod) {
        return self::match(['POST'], $url, $controllerMethod);
    }

    /**
     * Sets the fallback route when no matching route is found
     *
     * @param String|Callable $controllerMethod
     * @return App\Route
     */
    public static function fallback($controllerMethod) {
        return self::$fallbackRoute = new Route(['POST', 'GET'],'', $controllerMethod);
    }

    /**
     * Will execute the route matching the url, using fallback route if not found
     *
     * @param String $url
     * @return Boolean $found
     */
    public static function exec($url) {
        $found = false;
        foreach(self::$routes as $route) {
            $vars = [];
            if($route->match($url, $vars)) {
                $found=true;
                echo $route->exec($vars);
                break;
            }
        }

        if(!$found) {
            if(!is_null(self::$fallbackRoute)) {
                self::$fallbackRoute->exec();
            }
        }

        return $found;
    }

    /**
     * Get the routes array as collection because collections are damn handy
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getRoutes() {
        return collect(self::$routes);
    }


}