<?php

include_once("config.php");
include_once("clientes.php");
/*Acesso de datos de BasedeDatos
  mysqli
  Singleton: Utilizando solo una instancia de una clase
  Constructor privado, metodos estaticos
*/
class AcessoDatos{
    private static $modelo = null;
    private $dbh = null;
    private $stmt_clientes = null;
    private $stmt_cliente = null;
    private $stmt_borrcliente = null;
    private $stmt_crearcliente = null;
    private $stmt_modcliente = null;

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

   public function borrarCliente($id) : bool {
    $this->stmt_borrcliente->bindValue(':id', $id);
    $this->stmt_borrcliente->execute();
    $resu = ($this->stmt_borrcliente->rowCount () == 1);
    return $resu;
}

public function crearCliente($cliente) : bool {            
    $this->stmt_crearcliente->execute( [$cliente->first_name, $cliente->last_name, $cliente->email, $cliente->gender, $cliente->ip_address, $cliente->telefono]);
    $resu = ($this->stmt_crearcliente->rowCount () == 1);
    return $resu;
}

public function modCliente($cliente) : bool {
    $this->stmt_modcliente->bindValue(":id",$cliente->id);
    $this->stmt_modcliente->bindValue(':nombre',$cliente->first_name);
    $this->stmt_modcliente->bindValue(':apellidos',$cliente->last_name);
    $this->stmt_modcliente->bindValue(':email',$cliente->email);
    $this->stmt_modcliente->bindValue(':genero',$cliente->gender);
    $this->stmt_modcliente->bindValue(':dir_ip',$cliente->ip_address);
    $this->stmt_modcliente->bindValue(':telefono',$cliente->telefono);
    $this->stmt_modcliente->execute();
    $resu = ($this->stmt_modcliente->rowCount () == 1);
    return $resu;
}

public function totalClientes ():int{
    $resu = $this->dbh->query(" Select Count(*) from Clientes");
    $valor = $resu->fetch_array();
    return ($valor[0]); 
}

 // Evito que se pueda clonar el objeto. (SINGLETON)
 public function __clone()
 { 
     trigger_error('La clonación no permitida', E_USER_ERROR); 
 }




    
}