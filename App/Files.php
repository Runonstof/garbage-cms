<?php

namespace App;

use Tightenco\Collect\Support\Collection;

class Files {
    public static function get($pattern, $recursive=true, $includeDirs=false, &$files=[]) {
        $pattern = str_replace('/', '\\', $pattern);

        foreach(glob($pattern) as $file) {
            if(is_dir($file)) {
                if($includeDirs) { $files[] = $file; }
                if($recursive) {
                    self::get($file.'\**', true, $includeDirs, $files);
                }
            } elseif(is_file($file)) {
                if(array_search($file, $files) === false) {
                    $files[] = $file;
                }
            }
        }

        return collect($files);
    }

    public static function info($pattern, $recursive=true) {
        return collect(self::get($pattern,$recursive,false))->{'map'.($recursive ? 'Recursive' : '')}(function($file){ return pathinfo($file); });
    }
}