<?php
include_once 'config.php';
require_once 'Cliente.php';

class AccesoDAO {
    private static $modelo = null;
    private $dbh = null;
    private $stmt_clientes = null;

    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDAO();
        }
        return self::$modelo;
    }
    
    

     // Constructor privado  Patron singleton
   
     private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

        //Construto las consultas
        $this->stmt_clientes = $this->dbh->prepare("Select * from clientes limit :primero , :cuantos");

        // Construyo las consultas de golpe y no las emulo.
        $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        try {
        $this->stmt_clientes  = $this->dbh->prepare("select * from clientes");
        $this->stmt_usuario   = $this->dbh->prepare("select * from clientes where login=:login");
        $this->stmt_boruser   = $this->dbh->prepare("delete from clientes where login =:login");
        $this->stmt_moduser   = $this->dbh->prepare("update clientes set nombre=:nombre, password=:password, comentario=:comentario where login=:login");
        $this->stmt_creauser  = $this->dbh->prepare("insert into clientes (login,nombre,password,comentario) Values(?,?,?,?)");
        } catch ( PDOException $e){
            echo " Error al crear la sentencias ".$e->getMessage();
            exit();
        }
    
    }

    
    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->stmt_clientes = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de clientes
    public function getClientes (int $primero,int $cuantos):array {
        $tuser = [];
        $this->stmt_clientes->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->stmt_clientes->bindParam(":cuantos",$cuantos,PDO::PARAM_INT);
        $this->stmt_clientes->bindParam(":primero",$primero,PDO::PARAM_INT);
        if ( $this->stmt_clientes->execute() ){
            while ( $user = $this->stmt_clientes->fetch()){
               $tuser= $this->stmt_clientes->fetchAll();
            }
        }
        return $tuser;
    }

    public function totalClientes():int{
        $resu=$this->dbh->query("Select Count(*) from Clientes");
        $valor = $resu-> fetch();
        echo "VALOR = ". $valor;
        die();
    }
    

     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}