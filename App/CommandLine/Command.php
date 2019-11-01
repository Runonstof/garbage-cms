<?php

namespace App\CommandLine;

/**
 * A Garbage CMS Command
 */
class Command {
    public static $commands = [];
    public static $attr_rgx = '/{(\w+)}/'; //Regex to match argument definitions in the command
    public static $optional_attr_rgx = '/(?:\/)?{(\w+)\?}/'; //Regex to match optional argument definitions in the command

    public $name = '';
    public $description = '';
    public $command = null;

    public function __construct() {
        
    }

    public function register() {
        self::$commands[$this->name] = $this;
    }


    /**
     * Returns if the given string matches the command, $vars is for getting the arguments.
     *
     * @param string $string
     * @param array $vars
     * @return bool $matches
     */
    public function match($string, &$vars=[]) {
        $string = trim($string);
        $m = [];
        $result = preg_match($this->toRegex(),$string, $m);

        $names = $this->getArgNames();
        
        foreach($names as $i=>$name) {
            $vars[$name] = $m[$i+1]??null;
            if(is_string($vars[$name])) {
                $vars[$name] = trim($vars[$name], " \t\n\r\0\x0B\"'"); //transform ""a string   "" to "a string"
            }
        }

        
        return $result != 0 && $result !== false;
    }

    /**
     * Run command filler
     *
     * @return mixed
     */
    public function run() {
        echo output()->getColoredString("ERROR: This command has no method\n", 'white', 'red');
    }

    /**
     * Returns the regular expression of the garbage command to match a string on
     *
     * @return string
     */
    public function toRegex() {
        $rgx = str_replace(' ', '', $this->command);
        $rgx = preg_replace(self::$attr_rgx, '\s+([\S]+?|"[\s\S]+?"|\'[\s\S]+?\')',$rgx); //Replace required arguments with their equivalent regex
        $rgx = preg_replace(self::$optional_attr_rgx, '(?:\s+([\S]+?|"[\s\S]+?"|\'[\s\S]+?\'))?',$rgx); //Replace optional arguments with their equivalent regex
        $rgx = preg_replace('/\//', '\/', $rgx); //Make sure all slashes are escaped in the regex
        //Thats Why I didnt in the earlier regex replacements
        return '/^'.$rgx.'$/'; //Returns the full regex
    }

    /**
     * Get info about the arguments in the command
     *
     * @return Collection
     */
    public function getArgs() {
        $args = [];
        if(!is_null($this->command)) {
            $names = [];
            $attr_rgx = '/{([\w]+)(\?)?}/';
            preg_match_all($attr_rgx, $this->command, $names);
            
            foreach($names[1] as $i => $name) {
                $args[$name] = [
                    'index' => $i,
                    'required' => ($names[2][$i] != '?')
                ];
    
    
            }
        }
        return collect($args);
    }

    /**
     * Get the names of the arguments in the command
     *
     * @return void
     */
    public function getArgNames() {
        return $this->getArgs()->keys();
    }
}