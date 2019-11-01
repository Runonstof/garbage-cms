<?php

namespace App\Http\Validator;


class Rule {
    public static $rules = null;

    public $name = '';
    public $errorMessage = '';
    public $ruleMethod = null;

    public static function make($name, $ruleMethod=null) {
        return new Rule($name, $ruleMethod);
    }

    public static function get($name) {
        self::init();
        
        if(!array_key_exists($name, self::$rules??[])) {
            throw new Exception('Rule \''.$name.'\' doesn\'t exist!');
        }

        return self::$rules[$name];
    }

    public static function init() {
        if(is_null(self::$rules)) {
            self::$rules = [];

            //=====================================
            // Register default rules to validator
            // Feel free to add/edit
            // 
            // - Runonstof
            //=====================================

            new Rule('required', function($value,$args){
                return !is_null($value) && !empty($value);
            });
            new Rule('email', function($value){
                return filter_var($value, FILTER_VALIDATE_EMAIL);
            });
            new Rule('regex', function($value,$args){
                if(count($args) == 0) {
                    throw new Exception('Rule \'regex\' requires a regular expression!');
                }

                $match = preg_match($args[0], $value);
                return $match != 0 && $match !== false;
            });
            new Rule('numeric', function($value){
                return is_numeric($value);
            });
            new Rule('datetime', function($value){
                return strtotime($value) !== false;
            });
            new Rule('min', function($value,$args){
                if(count($args) == 0) {
                    throw new Exception('Rule \'min\' requires a minimum value!');
                }

                return strlen(strval($value)) >= $args[0];
            });
            new Rule('max', function($value,$args){
                if(count($args) == 0) {
                    throw new Exception('Rule \'max\' requires a maximum value!');
                }

                return strlen(strval($value)) <= $args[0];
            });
            new Rule('json', function($value){
                return is_json($value);
            });
            new Rule('contains', function($value, $args){
                foreach($args as $arg) {
                    if(strpos($value, $arg) !== false) {
                        return true;
                    }
                }
                return false;
            });
            
            new Rule('nullable', function(){ return true; });
        }
    }
    
    public function __construct($name, $ruleMethod=null, $errorMessage='') {
        self::init();

        $this->name = $name;
        $this->ruleMethod = $ruleMethod;
        $this->errorMessage = $errorMessage;

        self::$rules[$this->name] = $this;
    }

    public function exec($value,$args=[],$vars=[]) {
        if(is_callable($this->ruleMethod)) {
            return call_user_func_array($this->ruleMethod,[$value,$args,$vars]);
        }
        return true;
    }
}