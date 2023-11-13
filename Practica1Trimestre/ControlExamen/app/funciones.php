<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login,$clave):bool {
    global $usuarios;
    $resu=false;
    foreach($usuarios as $key => $value){
        if(($login==$key)&&($clave==$value[1])){
            $resu=true;
        }
    }
    return $resu;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;
    $rol;
    foreach($usuarios as $key => $value){
        if($key==$login){
            $rol=$value[2];
            break;
        }
    }
    return $rol;
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido/a alumno/a: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg.="<tr><th>Modulo</th><th>Notas</th></tr>";
    // Completar
    for($i=0;$i<count($nombreModulos);$i++){
        $msg .= "<tr>";
            $msg .= "<th>".$nombreModulos[$i]."</th>";
            $msg .= "<td>".$notas[$codigo][$i]."</td>";
        $msg .= "</tr>";
    }
    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $numLength=count($nombreModulos);
    $llaveNotas=array_keys($notas);
    $msg .= " Bienvenido Profesor: ". $usuarios[intval($codigo)][0];
    $msg .= "<table border='2px solid'>";

        $msg.="<tr>";
            $msg.="<th>Nombre</th>";
        for($i=0;$i<$numLength;$i++){
            $msg.="<th>".$nombreModulos[$i]."</th>";
        }
        $msg.="</tr>";
        for($i=0;$i<count($notas);$i++){
            $msg.="<tr>";
                $msg.="<th>".$usuarios[$llaveNotas[$i]][0]."</th>";
                for($y=0;$y<count($nombreModulos);$y++){
                    $msg.="<td>".$notas[$llaveNotas[$i]][$y]."</td>";
                }
            $msg.="</tr>";
        }
    $msg .= "</table>";
    return $msg;
}