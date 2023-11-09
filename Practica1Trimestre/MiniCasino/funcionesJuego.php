<?php
//Juego
function resultadoJuego(){
$msj=""; 
$val=generarNumero();
 if(esPar($val)){
    $msj="par";
 }else {
    $msj="impar";
 }
 return $msj;
}

function generarNumero(){
    $val=random_int(0,1);
    return $val;
}

function esPar($num){
    $resu=false;
    if($num%2==0){
        $resu = true;
    }
    return $resu;
}

//Apuesta Funciones
$msjResultadoApuesta="";
$msjResultado="";
if(isset($_POST['boton'])&&$_POST['boton']=='apostar'&&!empty($_POST['juego'])&&!empty($_POST['dineroApostar'])){
    //VARIABLES
    $radioSel=$_POST['juego'];
    $dineroApostado=$_POST['dineroApostar'];
    $dineroActual=$_SESSION['dinero'];
    $resultadoJuego=resultadoJuego();
    

    if(tienePasta($dineroApostado,$dineroActual)){
        $msjResultado="Resultado del juego : ".$resultadoJuego;
        if(ganaste($radioSel,$resultadoJuego)){
            $msjResultadoApuesta="GANASTE!";
            $_SESSION['dinero']+=$dineroApostado;
        }else {
            $msjResultadoApuesta="PERDISTE!";
            $_SESSION['dinero']-=$dineroApostado;
        }
    }else{
        $msjResultadoApuesta="NO TIENES $dineroApostado € PARA APOSTAR!";
    }
    
}else if(isset($_POST['boton'])&&$_POST['boton']=='apostar'&&empty($_POST['juego'])&&empty($_POST['dineroApostar'])) {
    $msjResultado="Error: Rellena todos los campos";
}

function ganaste($radio,$resuJuego){
    if($radio==$resuJuego){
        return true;
    }else {
        return false;
    }
}

function tienePasta($dinApostado,$dinActual){
    $resu=true;
    if($dinApostado>$dinActual){
        $resu=false;
    }
    return $resu;
}

?>