<?php

namespace App;

class Session {
    private static $vars = null;
    private static $init = false;

    public function __construct() {
        $this->init();
    }

    public function init() {
        if(is_null(self::$vars)) {
            if(!isset($_SESSION['vars'])) {
                $_SESSION['vars'] = [];
            }
            self::$vars = &$_SESSION['vars'];
        }
        if(!self::$init) {
            self::$vars = collect(self::$vars)->filter(function($var){ //filter out flashed true
                return isset($var['flashed']) ? (!$var['flashed']) : true;
            })->map(function($var){ //set all flashed to true
                if(isset($var['flashed'])) {
                    $var['flashed'] = true;
                }
                return $var;
            })->toArray();
            self::$init = true;
        }
    }

    public function set($key, $value, $flash=false) {
        if(!$this->has($key)) {
            $newValue = [
                'key' => $key,
                'value' => $value
            ];

            if($flash) {
                $newValue['flashed'] = false;
            }

            self::$vars[] = $newValue;
        } else {
            self::$vars = collect(self::$vars)->map(function($var) use($key, $value){
                if($var['key'] == $key) {
                    $var['value'] = $value;
                }
                return $var;
            })->toArray();
        }

        return $this;
    }

    public function get($key, $default=null) {
        return collect(self::$vars)->first(function($var) use($key){
            return $var['key'] == $key;
        })['value']??$default;
    }

    public function has($key) {
        return collect(self::$vars)->filter(function($var) use($key){
            return $var['key'] == $key;
        })->count() == 1;
    }

    public function flash($key, $value) {
        $this->set($key, $value, true);
    }

    public function dump() {
        return print_r(self::$vars, true);
    }

    public function json($options=0) {
        return json_encode(self::$vars, $options);
    }

    public function flush() {
        if(!is_null(self::$vars)) {
            self::$vars = [];
        }
    }

}