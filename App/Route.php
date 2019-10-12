<?php

namespace App;

use App\Controllers;

/**
 * Route class for handling with a single route
 */
class Route {
    public $url = '';
    public $methods = '';
    public $name = '';
    public $controllerAction = '';
    public static $attr_rgx = '/{(\w+)}/'; //Regex to match argument definitions in url
    public static $optional_attr_rgx = '/(?:\/)?{(\w+)\?}/'; //Regex to match optional argument definitions in url

    /**
     * Constructor
     *
     * @param Array $methods
     * @param String $url
     * @param String|Callable $controllerAction
     */
    public function __construct($methods, $url, $controllerAction) {
        $this->url = trim($url,'/');
        $this->methods = $methods;
        $this->controllerAction = $controllerAction;
    }

    /**
     * Sets the route name
     *
     * @param String $name
     * @return App\Route
     */
    public function name($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Converts the route url to regex to match a string on :D
     *
     * @return String
     */
    public function urlToRegex() {
    

        $rgx = $this->url;
        $rgx = preg_replace(self::$attr_rgx, '([\S]+?)',$rgx); //Replace required arguments with their equivalent regex
        $rgx = preg_replace(self::$optional_attr_rgx, '(?:/([\S]+?))?',$rgx); //Replace optional arguments with their equivalent regex
        $rgx = preg_replace('/\//', '\/', $rgx); //Make sure all slashes are escaped in the regex
        //Thats Why I didnt in the earlier regex replacements
        return '/^'.$rgx.'$/'; //Returns the full regex
    }

    /**
     * Get an array of argument names of url in order
     *
     * @return Array
     */
    public function urlArgumentNames() {

        $names = [];

        $attr_rgx = '/{([\w]+)\??}/';
        preg_match_all($attr_rgx, $this->url, $names);

        return $names[1];
        
    }

    /**
     * Match the given url with the route's url
     * and puts the supplied arguments in the
     * $vars array
     *
     * @param String $url
     * @param array $vars
     * @return void
     */
    public function match($url, &$vars=[]) {
        $url = trim($url,'/');
        $m = [];
        $result = preg_match($this->urlToRegex(),$url, $m);
        

        $names = $this->urlArgumentNames();
        
        foreach($names as $i=>$name) {
            $vars[$name] = $m[$i+1]??null;
        }

        
        return $result != 0 && $result !== false;
    }

    /**
     * Executes the route's function
     *
     * @param array $args
     * @return Mixed
     */
    public function exec($args=[]) {

        $action = null;
        if(is_string($this->controllerAction)) {
            $caSplitted = explode('@', $this->controllerAction);
    
            
            $controllerName = 'App\Controllers\\'.$caSplitted[0];
    
    
            $method = $caSplitted[1];
    
            $controller = new $controllerName;
            $action = [$controller, $method];
        } elseif(is_callable($this->controllerAction)) {
            $action = $this->controllerAction;
        }

        return \call_user_func_array($action, $args)??'';
    }
}