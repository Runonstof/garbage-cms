<?php

use App\Route;
use App\Session;
use App\Http\Response;
use App\CommandLine\Output;
use Jenssegers\Blade\Blade;
use Dotenv\Exception\ValidationException;


if(!function_exists('response')) {
    function response($content='',$status=200,$headers=[]) {
        return new Response($content, $status, $headers);
    }
}
 
if(!function_exists('blade')) {
    function blade($blade, $data=[]) {
        $blades = new Blade('./../views', './../cache');

        return $blades->make($blade)->with($data);
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
     * Returns route url with filled arguments
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
    function __($translation_name, $data=[]) {
        $string = $GLOBALS['lang']['strings'][$translation_name]??'Translation not found.';

        if(is_array($string)) {
            $string = implode('<br>',$string);
        }

        foreach($data as $key=>$value) {
            $string = str_replace('{'.strval($key).'}', $value, $string);
        }
        return $string;
    }
}

if(!function_exists('session')) {
    function session() {
        return new Session;
    }
}

if(!function_exists('output')) {
    function output() {
        return new Output;
    }
} 

if(!function_exists('is_json')) {
    function is_json($string) {
        json_decode($string);
        return json_last_error() == JSON_ERROR_NONE;
    }
}

function debug(...$txt) {
    file_put_contents('debug.txt', file_get_contents('debug.txt').implode("\n",$txt)."\n");
}

function genToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

   for ($i=0; $i < $length; $i++) {
       $token .= $codeAlphabet[random_int(0, $max-1)];
   }

   return $token;
}