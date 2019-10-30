<?php

namespace App\Models\Core;

class ModelMeta {
    public static $types = ['string','text','int','float','double','boolean'];
    public $name = '';
    public $type = null;
    public $value = null;
    public $model_id = 0;
    public $id = 0;

    public function __construct($name, $type) {
        if (!in_array($type, self::$types)) {
            throw new Exception('ModelMeta \''.$name.'\' can only be: '.implode(', ', self::$types));
        }
        
        $this->name = $name;
        $this->type = $type;
    }
}