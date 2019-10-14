<?php

namespace App;

use App\DB;

class Model {
    protected $type;
    protected $name;
    protected $attributes = [];

    public static function register($type) {
        //DB::select("");
    }

    public function __construct($type, $name, $attributes) {
        $this->type = $type;
        $this->name = $name;
        $this->attributes = $attributes;
    }
}