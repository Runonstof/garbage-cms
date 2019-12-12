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
        return  collect(self::query()->select('table_name')->table('information_schema.tables')->where('table_schema', 'garbagecms')->get())->pluck('TABLE_NAME');
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

    public static function query() {
        self::init();

        $connection = self::$db;

        $q = new \ClanCats\Hydrahon\Builder($_ENV['DB_TYPE'], function($query, $queryString, $queryParameters) use($connection)
        {
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);
        
            // when the query is fetchable return all results and let hydrahon do the rest
            if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
            {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        });

        return $q;
    }
}