<?php
use Jenssegers\Blade\Blade;
use App\Route;
use Psr\Log\InvalidArgumentException;

if(!function_exists('blade')) {
    function blade($blade, $data=[]) {
        $blades = new Blade('./../views', './../cache');

        return $blades->make($blade, $data);
    }
}

if(!function_exists('getRoute')) {
    function getRoute($name) {
        return collect(Route::$routes)->firstWhere('name', $name);
    }
}

if(!function_exists('route')) {
    function route($name, $vars=[]) {
        $route = getRoute($name);
        if(!is_null($route)) {
            $url = $route->url;
            $argNames = $route->getUrlArgNames();
            $argInfo = $route->getUrlArgs();
            
            $hasAllArgs = true;
            foreach($argInfo as $argName=>$info) {
                if(array_search($argName, array_keys($vars)) === false) {
                    $hasAllArgs = false;
                    break;
                }
                $url = str_replace('{'.$argName.($info['required'] ? '' : '?').'}', $vars[$argName],$url);
            }
        } else {
            throw 'Route "'.$name.'" does not exists!';
        }
        

        if(!$hasAllArgs) {
            $requiredArgCount = $route->getUrlArgs()->where('required')->count();

            //throw 'Route "'.$name.'" expects '.$requiredArgCount.' parameters, '.count(array_keys($vars)).' given.';
        }

        
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
          "%s://%s",
          isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
          $_SERVER['SERVER_NAME']
        );
      }
      
}