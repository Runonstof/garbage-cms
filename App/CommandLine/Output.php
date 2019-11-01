<?php

namespace App\CommandLine;

class Output {
    private $foreColors = array();
    private $backColors = array();

    public function __construct() {
        // Set up shell colors
        $this->foreColors['black'] = '0;30';
        $this->foreColors['dark_gray'] = '1;30';
        $this->foreColors['blue'] = '0;34';
        $this->foreColors['light_blue'] = '1;34';
        $this->foreColors['green'] = '0;32';
        $this->foreColors['light_green'] = '1;32';
        $this->foreColors['cyan'] = '0;36';
        $this->foreColors['light_cyan'] = '1;36';
        $this->foreColors['red'] = '0;31';
        $this->foreColors['light_red'] = '1;31';
        $this->foreColors['purple'] = '0;35';
        $this->foreColors['light_purple'] = '1;35';
        $this->foreColors['brown'] = '0;33';
        $this->foreColors['yellow'] = '1;33';
        $this->foreColors['light_gray'] = '0;37';
        $this->foreColors['white'] = '1;37';

        $this->backColors['black'] = '40';
        $this->backColors['red'] = '41';
        $this->backColors['green'] = '42';
        $this->backColors['yellow'] = '43';
        $this->backColors['blue'] = '44';
        $this->backColors['magenta'] = '45';
        $this->backColors['cyan'] = '46';
        $this->backColors['light_gray'] = '47';
    }

    // Returns colored string
    public function getColoredString($string, $foreColor = null, $backColor = null) {
        $colorString = "";

        // Check if given foreground color found
        if (isset($this->foreColors[$foreColor])) {
            $colorString .= "\033[" . $this->foreColors[$foreColor] . "m";
        }
        // Check if given background color found
        if (isset($this->backColors[$backColor])) {
            $colorString .= "\033[" . $this->backColors[$backColor] . "m";
        }

        // Add string and end coloring
        $colorString .=  $string . "\033[0m";

        return $colorString;
    }

    // Returns all foreground color names
    public function getForegroundColors() {
        return array_keys($this->foreColors);
    }

    // Returns all background color names
    public function getBackgroundColors() {
        return array_keys($this->backColors);
    }

    // Clears php CLI Output
    public function clear($returns=false) {
        $clearText = chr(27).chr(91).'H'.chr(27).chr(91).'J'; 
        if($returns) {
            return $clearText;
        } else {
            echo $clearText;
        }
        return null;
    }

}