<?php
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","empresa");

class AccesoDatos{
    private static $modelo = null;
    private $dbh= null;

 public static function initModelo(){
    if(self::$modelo==null){
        self::$modelo=new AccesoDatos();
    }
    return self::$modelo;
 }

 private function __construct(){
    try{
    $dsn="mysql:host=".DB_SERVER.";dbname=".DB_NAME;
    $this->dbh=new PDO($dsn,"root","");
    $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error de conexión".$e->getMessage();
        exit();
    }
 }

 //consultas

 public function consulta0(){
    $resu=[];
    $stmt=$this->dbh->prepare("SELECT * FROM clientes");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC significa devolver una array asociativa.
    
    if($stmt->execute()){
        while($row=$stmt->fetch()){
            array_push($resu,$row);
        }
    }

    return $resu;
 }

 public function consulta1($precio){
    $resu=[];
    $stmt=$this->dbh->prepare("SELECT * FROM productos WHERE PRECIO_ACTUAL > :precio ORDER BY DESCRIPCION");
    $stmt->bindValue(":precio",$precio);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC significa devolver una array asociativa.
    
    if($stmt->execute()){
        while($row=$stmt->fetch()){
            array_push($resu,$row);
        }
    }

    return $resu;
 }


 public function consulta2(){
    $resu=[];
    $stmt=$this->dbh->prepare("SELECT productos.DESCRIPCION, count(*) as TOTAL_NUM_PEDIDOS, sum(UNIDADES) as TOTAL_UNIDADES_PEDIDOS from productos,pedidos
     WHERE pedidos.PRODUCTO_NO=productos.PRODUCTO_NO GROUP BY 1");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    if($stmt->execute()){
        while($row=$stmt->fetch()){
            array_push($resu,$row);
        }
    }
    return $resu;
 }


 public function consulta3(){
    $resu=[];
    $stmt=$this->dbh->prepare("SELECT DEP_NO,count(EMP_NO) as NUM_EMPLEADOS from empleados group by dep_no order by 2 desc limit 1");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    if($stmt->execute()){
        while($row=$stmt->fetch()){
            array_push($resu,$row);
        }
    }
    return $resu;
 }

 
 public function consulta4(){
    $resu=[];
    $stmt=$this->dbh->prepare("SELECT empleados.EMP_NO,empleados.APELLIDO,departamentos.LOCALIDAD from empleados,departamentos where empleados.DEP_NO=departamentos.DEP_NO");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    if($stmt->execute()){
        while($row=$stmt->fetch()){
            array_push($resu,$row);
        }
    }
    return $resu;
 }


 public function consulta5($cliente){
    $resu=[];
    $stmt=$this->dbh->prepare("SELECT * from productos where PRODUCTO_NO not in (select pedidos.PRODUCTO_NO from pedidos where cliente_no = :cliente)");
    $stmt->bindParam(":cliente",$cliente);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    if($stmt->execute()){
        while($row=$stmt->fetch()){
            array_push($resu,$row);
        }
    }
    return $resu;
 }

}