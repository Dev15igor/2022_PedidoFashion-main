<?php
use PDO;

class Conexao{

    //Single
    private static $instance;

    public static function getInstance(){


        if(!isset(self::$instance)){

            try{

                self::$instance = new PDO('mysql:host=' . getenv("DB_HOST") . ';dbname=' . getenv("DB_NAME"), getenv("DB_USER"), getenv("DB_PASSWORD"));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        return self::$instance;

    }

    public static function prepare($sql){


        return self::getInstance()->prepare($sql);


    }

}

