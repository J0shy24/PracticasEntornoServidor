<?php

class AccesoDatos{
    private static $modelo;
    private $dbh;

    private function __construct(){
        try{
            $dsn="mysql:host=localhost;port=3308;dbname=telefonica";
            $this->dbh=new PDO($dsn,"root","");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            print "Error: ".$e->getmessage();
            die();
        }
    }

    public static function getModelo(){
        if(self::$modelo==null){
            self::$modelo=new AccesoDatos();
        }

        return self::$modelo;
    }

    public function closeModelo(){
        if(self::$modelo!=null){
            $this->dbh=null;
            self::$modelo=null;
        }
    }

    //consultas

    public function getClientes($puntos){
        
    }
}