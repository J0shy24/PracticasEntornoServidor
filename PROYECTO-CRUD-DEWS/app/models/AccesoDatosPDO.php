<?php

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería PDO *******************
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        try {
            $dsn = "mysql:host=".DB_SERVER.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }  

    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo cuantos filas tiene la tabla

    public function numClientes ():int {
      $result = $this->dbh->query("SELECT id FROM Clientes");
      $num = $result->rowCount();  
      return $num;
    } 
    

    // SELECT Devuelvo la lista de Usuarios
    public function getClientes ($primero,$cuantos,$ordenacion,$tipoOrdenacion):array {
        $tuser = [];
        // Crea la sentencia preparada
        $stmt_usuarios  = $this->dbh->prepare("select * from Clientes ORDER BY $ordenacion $tipoOrdenacion limit $primero,$cuantos");
        $stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
    
        if ( $stmt_usuarios->execute() ){
            while ( $user = $stmt_usuarios->fetch()){
               $tuser[]= $user;
            }
        }
        // Devuelvo el array de objetos
        return $tuser;
    }
    
      
    // SELECT Devuelvo un usuario o false
    public function getCliente (int $id) {
        $cli = false;
        $stmt_cli   = $this->dbh->prepare("select * from Clientes where id=:id");
        $stmt_cli->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $stmt_cli->bindParam(':id', $id);
        if ( $stmt_cli->execute() ){
             if ( $obj = $stmt_cli->fetch()){
                $cli= $obj;
            }
        }
        return $cli;
    }

     
    public function getClienteSiguiente($ordenacion,$dato){

        $cli = false;
        
        $stmt_cli   = $this->dbh->prepare("select * from Clientes where $ordenacion > ? ORDER BY $ordenacion limit 1");
        // Enlazo $id con el primer ? 
        $stmt_cli->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $stmt_cli->bindParam(1,$dato);

        if ( $stmt_cli->execute() ){
            if ( $obj = $stmt_cli->fetch()){
               $cli= $obj;
           }
       }
        return $cli;

    }

    public function getClienteAnterior($ordenacion,$dato){

        $cli = false;
        
        $stmt_cli   = $this->dbh->prepare("select * from Clientes where $ordenacion < ? order by $ordenacion DESC limit 1");
       // Enlazo $id con el primer ? 
       $stmt_cli->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $stmt_cli->bindParam(1,$dato);

        if ( $stmt_cli->execute() ){
           if ( $obj = $stmt_cli->fetch()){
              $cli= $obj;
          }
        }
       
    return $cli;

    }

    public function getEmail($email){
        $resu=false;

        $stmt=$this->dbh->prepare("select * from clientes where email = ?");
        $stmt->bindParam(1,$email);
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Cliente');
        if($stmt->execute()){
                $resu=$stmt->fetch();
            
        }
        return $resu;
    }


    // UPDATE TODO
    public function modCliente($cli):bool{
      
        $stmt_moduser   = $this->dbh->prepare("update Clientes set first_name=:first_name,last_name=:last_name".
        ",email=:email,gender=:gender, ip_address=:ip_address,telefono=:telefono WHERE id=:id");
        $stmt_moduser->bindValue(':first_name', $cli->first_name);
        $stmt_moduser->bindValue(':last_name'   ,$cli->last_name);
        $stmt_moduser->bindValue(':email'       ,$cli->email);
        $stmt_moduser->bindValue(':gender'      ,$cli->gender);
        $stmt_moduser->bindValue(':ip_address'  ,$cli->ip_address);
        $stmt_moduser->bindValue(':telefono'    ,$cli->telefono);
        $stmt_moduser->bindValue(':id'          ,$cli->id);

        $stmt_moduser->execute();
        $resu = ($stmt_moduser->rowCount () == 1);
        return $resu;
    }

    //Mejora 8 y 9
    public function getLogin($usu){
        $resu=false;
        $stmt=$this->dbh->prepare("SELECT * FROM usuarios WHERE usuarios.login = ? limit 1");
        $stmt->bindParam(1,$usu);

        if($stmt->execute()){
            if($stmt->rowCount()==0){
                $resu=false;
            }else{
            $resu=$stmt->fetch()[0];
            }
        }   

        return $resu;
    }

    public function getPass($usu){
        $resu=false;
        $stmt=$this->dbh->prepare("SELECT contrasena FROM usuarios WHERE usuarios.login = ?");
        $stmt->bindParam(1,$usu);
        if($stmt->execute()){
            if($stmt->rowCount()==0){
                $resu=false;
            }else{
            $resu=$stmt->fetch()[0];
            }
        }

        return $resu;
    }

    public function getRol($usu){
        $resu=false;
        $stmt=$this->dbh->prepare("SELECT rol FROM usuarios WHERE usuarios.login = ?");
        $stmt->bindParam(1,$usu);

        if($stmt->execute()){
            if($stmt->rowCount()==0){
                $resu=false;
            }else{
            $resu=$stmt->fetch()[0];
            }
        }
        return $resu;
    }

  
    //INSERT 
    public function addCliente($cli):bool{
       
        // El id se define automáticamente por autoincremento.
        $stmt_crearcli  = $this->dbh->prepare(
            "INSERT INTO `Clientes`( `first_name`, `last_name`, `email`, `gender`, `ip_address`, `telefono`)".
            "Values(?,?,?,?,?,?)");
        $stmt_crearcli->bindValue(1,$cli->first_name);
        $stmt_crearcli->bindValue(2,$cli->last_name);
        $stmt_crearcli->bindValue(3,$cli->email);
        $stmt_crearcli->bindValue(4,$cli->gender);
        $stmt_crearcli->bindValue(5,$cli->ip_address);
        $stmt_crearcli->bindValue(6,$cli->telefono);    
        $stmt_crearcli->execute();
        $resu = ($stmt_crearcli->rowCount () == 1);
        return $resu;
    }

   
    //DELETE 
    public function borrarCliente(int $id):bool {


        $stmt_boruser   = $this->dbh->prepare("delete from Clientes where id =:id");

        $stmt_boruser->bindValue(':id', $id);
        $stmt_boruser->execute();
        $resu = ($stmt_boruser->rowCount () == 1);
        return $resu;
        
    } 

    //GET Ultimo cliente para la alta
    public function getAutoIncrementId(){
        $resu=false;
        $stmt=$this->dbh->prepare("SELECT AUTO_INCREMENT from information_schema.TABLES where TABLE_SCHEMA = 'testmockaroo' AND TABLE_NAME = 'clientes'"); //Query ultimo id
        if($stmt->execute()){
            $resu=$stmt->fetch()[0];
        }
        return $resu;
    }
    
    //INSERT NUEVO USUARIO TEST
     public function addUsuario($usu,$pass,$rol):bool{
        $stmt_crearcli  = $this->dbh->prepare("INSERT INTO `Usuarios` VALUES (?,?,?)");
        $stmt_crearcli->bindValue(1,$usu);
        $stmt_crearcli->bindValue(2,$pass);
        $stmt_crearcli->bindValue(3,$rol);  
        $stmt_crearcli->execute();
        $resu = ($stmt_crearcli->rowCount () == 1);
        return $resu;
    }


    
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }

    
}



