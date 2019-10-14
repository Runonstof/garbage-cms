<?php

function require_files($directory, &$imported=[]) {

    foreach(glob($directory.'*.*') as $file) {
        require $file;
    }

    foreach(glob($directory.'*') as $file) {
        require_files($file.'/');
    }
}

function setenv(array $values)
{

    $envFile = __DIR__ . '/.env';
    $str = file_get_contents($envFile);

    if (count($values) > 0) {
        foreach ($values as $envKey => $envValue) {

            if(is_bool($envValue)) {
                $envValue = $envValue ? 'true' : 'false';
            } elseif(is_string($envValue)) {
                $envValue = '"'.$envValue.'"';
            }

            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

            // If key does not exist, add it
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }

        }
    }

    $str = substr($str, 0, -1);
    if (!file_put_contents($envFile, $str)) return false;
    return true;

}