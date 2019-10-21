<?php

namespace App\Http\Validator;


class Rule {
    public static $rules = null;

    public $name;
    public $errorMessage = '';
    public $ruleMethod;

    public static function make($name, $ruleMethod=null) {
        return new Rule($name, $ruleMethod);
    }

    public static function get($name) {
        self::init();
        
        if(!array_key_exists($name, self::$rules)) {
            throw new Exception('Rule \''.$name.'\' doesn\'t exist!');
        }

        return self::$rules[$name];
    }

    public static function init() {
        if(is_null(self::$rules)) {
            self::$rules = [];

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
                debug('RGX: '.$args[0]);
                debug('VAL: '.$value);

                $match = preg_match($args[0], $value);
                debug('MATCH: '.print_r($match,true));
                return $match != 0 && $match !== false;
            });
            new Rule('numeric', function($value){
                return is_numeric($value);
            });
            new Rule('datetime', function($value){
                return strtotime($value) !== false;
            });
            //rule for readability
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
}