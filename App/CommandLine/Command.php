<?php

namespace App\CommandLine;

use App\CommandLine\Output;

/**
 * A Garbage CMS Command
 */
class Command {
    private static $commands = [];
    private static $attr_rgx = '/{(\w+)}/'; //Regex to match argument definitions in the command
    private static $optional_attr_rgx = '/(?:\/)?{(\w+)\?}/'; //Regex to match optional argument definitions in the command

    public $name = '';
    public $description = '';
    public $command = null;
    public $run = null;

    /**
     * Make a new Command object that gets registered immediatly
     *
     * @param string $name Name of the command.
     * @param string $description Description of the command.
     * @param string $command The command usage notation.
     * @param Callable $runFunction The function to execute when command is called
     * @return void
     */
    public static function create($name, $description, $command, $runFunction=null) {
        $cmd = new self;
        $cmd->name = $name;
        $cmd->description = $description;
        $cmd->command = $command;

        $cmd->run = $runFunction??function($self){
            $output = new Output;
            echo $output->getColoredString("Command '".$self->name."' has no run function!\n", "white", "red");
        };

        return $cmd->register();
    }

    /**
     * Register command to global command list
     *
     * @return Command
     */
    public function register() {
        self::$commands[$this->name] = $this;

        return $this;
    }
    
    public function execute($vars=[]) {
        if(is_callable($this->run)) {
            return call_user_func_array($this->run, [$this, $vars]);
        }

        return null;
    }

    /**
     * Returns all commands in the global list
     *
     * @return Collection
     */
    public static function all() {
        return collect(self::$commands);
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
            if(is_float($vars[$name])) {
                $vars[$name] = floatval($vars[$name]);
            }
            if(is_int($vars[$name])) {
                $vars[$name] = intval($vars[$name]);
            }
        }

        
        return $result != 0 && $result !== false;
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

    public static function registerDefaultCommands() {

        //Register help command (command-inception hehe)
        self::create('Help', 'Shows this screen', 'help {page?}', function($cmd, $args){

            $page = $args['page']??0;

            $output = new Output;
            echo $output->getColoredString("garbage-cms help - page #".($page+1)."\n", "black", "light_gray");
            
            foreach(Command::all()->sortBy('command')->slice($page*10)->take(10) as $command) {
                echo 
                    $output->getColoredString("->", "black", "light_gray")." ".
                    $output->getColoredString($command->command, "yellow")." - ".
                    $output->getColoredString($command->name, "cyan")." - ".
                    $output->getColoredString($command->description, "green").
                    " \n";
            }
        });

        self::create('Generate Application Key', 'Generates a new unique application key used for security measures', 'generate-key', function($command){
            $output = new Output;

            setenv([
                'APP_KEY' => genToken(64)
            ]);

            echo $output->getColoredString("New application key generated\n\n", "green");
        });

        self::create('Clearscreen', 'Clears the output screen', 'cls', function(){
            $output = new Output;
            $output->clear();
        });

    }
}