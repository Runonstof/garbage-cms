<?php

namespace App;

use PDO;
use stdClass;
use PDOException;
use PDOStatement;
use Illuminate\Support\Collection;

class DB {

    public static $db = null;

    /**
     * Initialized the connection to the database, if it fails and no callback is provided, an exception is thrown.
     *
     * @param Callable $callback
     * @return void
     */
    public static function init($callback=null) {

        if(self::$db == null) {
            try {
                self::$db = new PDO($_ENV['DB_TYPE'].":host=".$_ENV['DB_HOST'].";port=".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
                // set the PDO error mode to exception
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            } catch(PDOException $e) {
                if(!is_callable($callback)) {
                    if($_ENV['DEBUG_MODE']??false) {
                        die('PDO ERROR: '.$e->getMessage());
                    } else {
                        die('PDO ERROR');
                    }
                } else {
                    $callback($e);
                }
            }
        }
    
    }

    /**
     * Closed the connection to the database
     *
     * @return void
     */
    public static function close() {
        if(!is_null(self::$db)) {
            self::$db = null;
        }
    }
    
    /**
     * List all databases
     *
     * @return Collection
     */
    public static function databases() {
        return self::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA");
    }

    /**
     * Gets all tables of a specific database
     *
     * @param string $dbname
     * @return Collection
     */
    public static function tables($dbname=null) {
        
        return self::select("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema=:dbname;",[
            'dbname' => is_null($dbname) ? $_ENV['DB_NAME'] : $dbname
        ]);
    }
    
    /**
     * Check if a database exists
     *
     * @param string $dbname
     * @return bool
     */
    public static function dbexists($dbname) {
        return in_array($dbname, self::databases()->toArray());
    }
    
    
    public static function exists() {
        $exists = true;
        self::init(function()use(&$exists){
            $exists = false;
        });

        return $exists;
    }

    /**
     * Query the database, returns an already executed prepared statement
     *
     * @param string $sql
     * @param array $values
     * @return PDOStatement
     */
    public static function query($sql, $values=[]) {
        self::init();

        $statement = self::$db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
        foreach($values as $key=>$value) {
            $statement->bindParam(':'.$key,$value);
        }

        try {
            $statement->execute();
        } catch (PDOException $e) {
            if($_ENV['DEBUG_MODE']) {
                die('PDO ERROR: '.$e->getMessage()."<br><br>".print_r($statement,true));
            } else {
                die('PDO ERROR');
            }
        }

        return $statement;
    }

    /**
     * Queries the database and fetches the data
     *
     * @param string $sql
     * @param array $values
     * @param boolean $assoc
     * @return Collection
     */
    public static function select($sql, $values=[],$assoc=true) {
        $statement = self::query($sql, $values);
        
        $queryResults = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$assoc) {
            $objs = [];
            
            foreach($queryResults as $row) {
                $obj = new stdClass;
                foreach($row as $key=>$value) {
                    $obj->{$key} = $value;
                }
                $objs[] = $obj;
            }

            return collect($objs);
        }

        return collect($queryResults);
    }
}