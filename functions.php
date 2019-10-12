<?php

function require_files($directory, &$imported=[]) {

    foreach(glob($directory.'*.*') as $file) {
        require $file;
    }

    foreach(glob($directory.'*') as $file) {
        require_files($file.'/');
    }
}