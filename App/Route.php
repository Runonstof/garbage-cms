<?php

namespace App;

use App\Controllers;


class Route {
    public $url = '';
    public $methods = '';
    public $name = '';
    public $controllerAction = '';
    public static $attr_rgx = '/{(\w+)}/';
    public static $optional_attr_rgx = '/(?:\/)?{(\w+)\?}/';

    public function __construct($methods, $url, $controllerAction) {
        $this->url = trim($url,'/');
        $this->methods = $methods;
        $this->controllerAction = $controllerAction;
    }

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function urlToRegex() {
    

        $rgx = $this->url;
        $rgx = preg_replace(self::$attr_rgx, '([\S]+?)',$rgx);
        $rgx = preg_replace(self::$optional_attr_rgx, '(?:/([\S]+?))?',$rgx);
        $rgx = preg_replace('/\//', '\/', $rgx);
        return '/^'.$rgx.'$/';
    }

    public function urlArgumentNames() {

        $names = [];

        $attr_rgx = '/{([\w]+)\??}/';
        preg_match_all($attr_rgx, $this->url, $names);

        return $names[1];
        
    }

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

        echo \call_user_func_array($action, $args)??'';
        

    }

    
}