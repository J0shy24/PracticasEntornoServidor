<?php
include("MiniCalculadora.html");

if(!isset($_POST['numero1'])|| !isset($_POST['numero2'])|| !isset($_POST['conversion'])){
    echo "Hay que rellenar todos los campos";
} else {
    //Datos Formulario
    $n1=$_POST['numero1'];
    $n2=$_POST['numero2'];
    $operador=$_POST['operador'];
    $conversion=$_POST['conversion'];

   if ($n2==0&&$operador=='/'){
    echo "No se puede dividir con 0";
    return;
   } 

   $resultado= calcular($n1,$operador,$n2);

   switch ($conversion){
    case 'decimal' : echo "El resultado en Decimal es : ".$resultado;break;
    case 'binario' : echo "El resultado en Binario es : ".decbin($resultado);break;
    case 'hexadecimal' : echo "El resultado en HexaDecimal es : ".dechex($resultado);break;
   }


}


//Funciones
function calcular($num1,$oper,$num2){
    $resu=0;
    switch ($oper){
        case '+':$resu= $num1+$num2;break;
        case '-':$resu= $num1-$num2;break;
        case '*':$resu= $num1*$num2;break;
        case '/':settype($resu,"float");$resu= $num1/$num2;break;
    }
    return $resu;
}

?>