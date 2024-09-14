<?php

class DB{
    private static $instance;
    public static function getInstance(){
        if(self::$instance != null){
            return self::$instance;
        }

        self::$instance = new PDO("mysql:host=localhost;dbname=blog","root","");
        return self::$instance;
        
    }
}
DB::getInstance();
?>