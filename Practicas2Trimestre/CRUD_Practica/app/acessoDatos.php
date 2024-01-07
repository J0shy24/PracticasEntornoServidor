<?php

include_once("config.php");
include_once("clientes.php");
/*Acesso de datos de BasedeDatos
  mysqli
  Singleton: Utilizando solo una instancia de una clase
  Constructor privado, metodos estaticos
*/
class AcessoDatos{
    private static $modelo=null; //Singleton
    private $dbh=null;

    //metodos

    //constructor singleton
    private function __construct(){
        $this->dbh=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

        //Error handling
        if($this->dbh->connect_error){
            die("Error con la conexion".$this->dbh->connect_errno); //Nos enseña el codigo del error
        }
    }
   //Metodos estaticos
   //devuelve el modelo, si no está creada hace una nueva. Modelo es estatico, solo puede haber una.
    public static function getModelo(){
        if(self::$modelo==null){
            self::$modelo=new AcessoDatos();
        }

        return self::$modelo;
    }

    //cierra el modelo/ lo hace null y el cierra el dbh
    public static function closeModelo(){
        if(self::$modelo!=null){
            self::$modelo->dbh->close();
            self::$modelo=null; 
        }
    }

    //Metodos de base de datos queries, updates, modify

    //Devuelve el numero de clientes
   public function numClientes(){
        $query=$this->dbh->query("SELECT id FROM clientes");
        $result=$query->num_rows;
        return $result;
   }

   //Devuelve una lista de los clientes con parametros de primer numero en la lista, y cuantía de clientes.
   public function getClientes($primero,$cuantos){
    $tclientes=[];
    $stmt_clientes=$this->dbh->prepare("SELECT * FROM clientes limit $primero,$cuantos");
    //error handling
    if($stmt_clientes==false){
        die(__FILE__.':'.__LINE__.$this->dbh->error);//Devuelve el php file + la linea + el error
    }

    //execute
    $stmt_clientes->execute();
    //resultados del query
    $resultados=$stmt_clientes->get_result();
    //si hay resultados
    if($resultados){
        while($cliente=$resultados->fetch_object('Cliente')){
            array_push($tclientes,$cliente);
            //Metemos todos los objetos clientes sacado en la base de datos en la tabla.
        }
    }
    return $tclientes;
   }

   
   public function getcliente($id){
    $cliente=false;
    $stmt_cliente=$this->dbh->prepare("SELECT * FROM clientes where id =?");
    if($stmt_cliente==false) die($this->dbh->error);

    //Enlazamos el paremetro con el id
    $stmt_cliente->bind_param("s",$id); //"s" significa string, estamos diciendo al funcion que el parametro puesto es un tipo string.
    $stmt_cliente->execute();
    $resultado=$stmt_cliente->get_result();
    if($resultado){
        $cliente=$resultado->fetch_object('Cliente');
    }
    return $cliente;
   }

   //





    
}