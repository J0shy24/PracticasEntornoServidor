<?php

use function PHPSTORM_META\type;

define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","empresa");

class AccesoDatos{
    private static $modelo;
    private $dbh;
    private $stmt_productos;
    private $stmt_update;
    
    private function __construct(){
        try{
        $dsn="mysql:host=".DB_SERVER.";dbname=".DB_NAME;
        $this->dbh= new PDO($dsn,"root","");
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "ERROR: ".$e->getMessage();
            exit();
        }

        $this->stmt_productos=$this->dbh->prepare("SELECT * from productos where producto_no not in (SELECT producto_no from pedidos)");
        $this->stmt_update=$this->dbh->prepare("UPDATE productos SET PRECIO_ACTUAL = PRECIO_ACTUAL - (PRECIO_ACTUAL*0.10) WHERE PRODUCTO_NO =  :codigo ");
    }


    public static function getModelo(){
        if(self::$modelo==null){
            self::$modelo=new AccesoDatos();
        }
        return self::$modelo;
    }

    //Funciones Consultas

    public function getProductos(){
        $productos=[];

        $this->stmt_productos->setFetchMode(PDO::FETCH_ASSOC);
        $this->stmt_productos->execute();

        while($row=$this->stmt_productos->fetch()){
            array_push($productos,$row);
        }

        return $productos;
    }

    public function bajarPrecio(array $productos){
       foreach($productos as $prod){
        $this->stmt_update->bindParam(":codigo",$prod);
        $this->stmt_update->execute();
       }
    }

}