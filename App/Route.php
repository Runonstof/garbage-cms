<?php

namespace App;

use Illuminate\Support\Collection;
use App\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Route class for handling with a single route
 */
class Route {
    public static $routes = [];
    public static $namePrefix = [];
    public static $urlPrefix = [];

    public static $fallbackRoute = null;

    public $url = '';
    private $methods = '';
    public $name = '';
    private $controllerAction = '';
    private $middleware = [];
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
        $this->url = trim(implode('',self::$urlPrefix).$url,'/');
        $this->methods = $methods;
        $this->controllerAction = $controllerAction;

        self::$routes[] = $this;
    }

    /**
     * Adds a route that accepts multiple request methods
     *
     * @param Array $methods
     * @param String $url
     * @param String|Callable $controllerMethod
     * @return App\Route
     */
    public static function create(Array $methods, String $url, $controllerMethod) {
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
        return self::create(['GET'], $url, $controllerMethod);
    }

    /**
     * Adds a route that accepts only requests via the POST method
     *
     * @param String $url
     * @param String|Callable $controllerMethod
     * @return App\Route
     */
    public static function post($url, $controllerMethod) {
        return self::create(['POST'], $url, $controllerMethod);
    }

    /**
     * Creates fallback route if none is found
     *
     * @param String $controllerMethod
     * @return App\Route
     */
    public static function fallback($controllerMethod) {
        return self::$fallbackRoute = new Route([],'',$controllerMethod);
    }

    /**
     * Tries to execute matching route with given url
     *
     * @param String $url
     * @return Boolean $found
     */
    public static function handle($url) {
        $found = false;
        foreach(self::$routes as $route) {
            $vars = [];
            if($route->match($url, $vars)) {
                $found=true;
                if(in_array($_SERVER['REQUEST_METHOD'], $route->methods)) {
                    $response = $route->exec($vars);
                    if($response instanceof SymfonyResponse) {
                        //if the response returned by controller is a response object
                        $response->send();
                    } elseif(is_string($response)) {
                        //if the response is a string, assume its HTML and make a response
                        (new Response($response, Response::HTTP_OK, ['content-type' => 'text/html']))->send();
                    }
                } else {
                    (new Response('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED))->send();
                }
                break;
            }
        }

        if(!$found) {
            if(!is_null(self::$fallbackRoute)) {
                
                echo self::$fallbackRoute->exec();
            }
        }

        return $found;
    }

    /**
     * Sets global name prefix for using before group call
     *
     * @param String $name
     * @return App\Route
     */
    public static function namePrefix($name) {
        self::$namePrefix[] = $name;
        return self::class;
    }

    /**
     * Sets global url prefix for using before group call
     *
     * @param String $url
     * @return App\Route
     */
    public static function urlPrefix($url) {
        self::$urlPrefix[] = $url;
        return self::class;
    }
    
    /**
     * Creates a route group
     *
     * @param Callable $callback
     * @return App\Route
     */
    public static function group($callback) {
        $callback();
        array_pop(self::$namePrefix);
        array_pop(self::$urlPrefix);
        return self::class;
    }

    /**
     * Sets the route name
     *
     * @param String $name
     * @return App\Route
     */
    public function name($name) {
        $this->name = implode('', self::$namePrefix).$name;
        return $this;
    }

    /**
     * Sets the route url
     *
     * @param String $url
     * @return App\Route
     */
    public function url($url) {
        $this->url = trim(implode('',self::$urlPrefix).$url, '/');
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
     * Get an collection of argument names of url in order
     *
     * @return Collection
     */
    public function getUrlArgNames() {
        return $this->getUrlArgs()->keys();
    }

    /**
     * Gets the arguments with their info
     *
     * @return Collection
     */
    public function getUrlArgs() {
        $args = [];

        $names = [];
        $attr_rgx = '/{([\w]+)(\?)?}/';
        preg_match_all($attr_rgx, $this->url, $names);
        
        foreach($names[1] as $i => $name) {
            $args[$name] = [
                'index' => $i,
                'required' => ($names[2][$i] != '?')
            ];


        }

        return collect($args);
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
        

        $names = $this->getUrlArgNames();
        
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


    public function toUrl($vars) {
        $url = $this->url;
        $argInfo = $this->getUrlArgs();
        $givenArgCount = 0;

        $hasAllArgs = true;
        foreach($argInfo as $argName=>$info) {
            if(array_search($argName, array_keys($vars)) === false && $info['required']) {
                $hasAllArgs = false;
                break;
            } else {
                $givenArgCount++;
            }
            $url = str_replace('{'.$argName.($info['required'] ? '' : '?').'}', $vars[$argName]??'',$url);
            
        }

            
        if(!$hasAllArgs) {
            $requiredArgCount = count($this->getUrlArgs()->where('required', 'true'));

            throw new \Exception("Route '{$this->name}' requires at least $requiredArgCount arguments, $givenArgCount given.");
        } else {
            return url().'/'.trim($url,'/');
        }

    

        return null;
    }
}