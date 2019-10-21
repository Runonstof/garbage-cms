<?php
use Jenssegers\Blade\Blade;
use App\Route;
use App\Session;
use Dotenv\Exception\ValidationException;
use Psr\Log\InvalidArgumentException;

if(!function_exists('blade')) {
    function blade($blade, $data=[]) {
        $blades = new Blade('./../views', './../cache');

        return $blades->make($blade, $data);
    }
}

if(!function_exists('getRoute')) {
    function getRoute($name) {
        $route = collect(Route::$routes)->firstWhere('name', $name); 
        if(is_null($route)) {
            throw new ValidationException("Route '$name' does not exists!");
        }

        return $route;
    }
}

if(!function_exists('route')) {
    /**
     * Undocumented function
     *
     * @param [type] $name
     * @param array $vars
     * @return void
     */
    function route($name, $vars=[]) {
        return getRoute($name)->toUrl($vars);
    }
}

if(!function_exists('mix')) {
    function mix($file) {
        return url().'/public/'.$file.'?v='.uniqid();
    }
}

if(!function_exists('url')) {
    function url(){
        return sprintf(
          "%s://%s%s",
          isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
          $_SERVER['SERVER_NAME'],
          $_SERVER['SERVER_NAME'] == 'localhost' ? '/'.explode('/',trim($_SERVER['REQUEST_URI'],'/').'/')[0] : ''
        );
      }
      
}

//this is translation function
if(!function_exists('__')) {
    /**
     * Get the translation string
     *
     * @param string $translation_name
     * @return void
     */
    function __($translation_name) {
        return $GLOBALS['lang']['strings'][$translation_name]??'Translation not found.';
    }
}

if(!function_exists('session')) {
    function session() {
        return new Session;
    }
}
