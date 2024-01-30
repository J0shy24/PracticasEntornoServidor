<?php
session_start();
//Bienvenido.php
if(isset($_GET['name'])){
    $_SESSION['nombre']=$_GET['name'];
 } 
  
if(!isset($_SESSION['nombre'])){
     require_once('Bienvenido.php');                                                                                
}else {

    if (isset($_POST['button'])&&$_POST['button']=="terminar"){
 //Despedido.php   
         
        require_once('Despedido.php');
        
    }else{
//Comprar.php
        if (empty($_SESSION['fruitTable'])){
            $_SESSION['fruitTable']=array();
        }
           if(isset($_POST['fruta'])&&isset($_POST['cantidad'])){
                $fruit=$_POST['fruta'];
                $quant=$_POST['cantidad'];
                añadir($fruit,$quant,$_SESSION['fruitTable']);
            } 
        require_once('Compra.php'); 
        
    }   
}

                                                         
//Funciones
function añadir($nomFruta,$numCant,&$tablaArray){

    if($numCant==0){}
    else
    if (array_key_exists($nomFruta,$tablaArray)){
        $valor=$tablaArray[$nomFruta];
        $tablaArray[$nomFruta]=$valor+$numCant;
    }else{
        $tablaArray[$nomFruta]=$numCant;
    }
}
?>