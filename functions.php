<?php

function require_files($directory) {
    foreach(glob($directory) as $file) {
        echo "$file<br>";
        if(is_dir($file)) {
            require_files($file);

        } elseif(is_file($file)) {
            if(filetype($file) == 'php') {
                
                require $file;
            }
        }
    }
}