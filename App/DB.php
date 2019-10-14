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

    public static function exists() {
        $exists = true;

        self::init(function() use(&$exists) {
            $exists = false;
        });

        return $exists;
    }

    public static function query($sql, $values) {
        self::init();

        foreach($values as $key=>$value) { //Escape all arguments in the SQL
            $sql = str_replace(':'.$key, \mysqli_real_escape_string($value));
        }

        $query = self::$db->query($sql);

        return $query;
    }

    public static function select($sql, $values) {
        $query_result = self::query($sql, $values);

        $results = [];

        if($query_result->num_rows > 0) {
            //Loop through results
            while($row = $query_result->fetch_assoc()) {
                $results[] = $row; //Push $row in $results array
            }
        }

        return $results;
    }
}