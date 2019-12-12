<?php

namespace App\Helpers;

use App\Files;

class InstallHelper {
    public static function getTables() {
        return Files::get('config/database/*.*',false,false)->map(function($file){
            return pathinfo($file);
        });
    }
}