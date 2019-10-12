<?php

function require_files($directory, &$imported=[]) {

    foreach(glob($directory) as $file) {
        if(array_search($file, $imported) === false) {
            $imported[] = $file;
            if(is_dir($file)) {
                require_files($file, $imported);
    
            } elseif(is_file($file)) {
                if(pathinfo($file, PATHINFO_EXTENSION) == 'php') {
                    require $file;
                }
            }
        }
    }
}