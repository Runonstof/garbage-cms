<?php

namespace App;

class DB {

    public static $db = null;

    public static function init($callback=null) {

        if(self::$db == null) {
            self::$db = @mysqli_connect(
                $_ENV['DB_HOST'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'],
                $_ENV['DB_NAME']
            );

            if(\mysqli_connect_errno()) {
                if(is_null($callback)) {
                    if($_ENV['DEBUG_MODE']) {
                        die('MYSQL ERROR: '.\mysqli_connect_error());
                    } else {
                        die('MYSQL ERROR!');
                    }
                } elseif(is_callable($callback)) {
                    $callback(mysqli_connect_errno(), mysqli_connect_error());
                }
            }
        }
    
    }

    

    public static function errno() {
        return \mysqli_connect_errno();
    }

    public static function databases() {
        return self::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMA");
    }

    public static function tables($dbname) {
        return self::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='{dbname}'", compact('dbname'));
    }
    
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


    public static function query($sql, $values=[]) {
        self::init();

        foreach($values as $key=>$value) { //Escape all arguments in the SQL
            $sql = str_replace(':'.$key, \mysqli_real_escape_string($value, self::$db), $sql);
        }

        $query = self::$db->query($sql);

        return $query;
    }

    public static function select($sql, $values=[],$assoc=true) {
        $query_result = self::query($sql, $values);

        $results = [];
        if($query_result) {
            if($query_result->num_rows > 0) {
                //Loop through results
                while($row = $query_result->{'fetch_'.($assoc ? 'assoc' : 'array')}()) {
                    $results[] = $row; //Push $row in $results array
                }
            }
        }

        return collect($results);
    }
}