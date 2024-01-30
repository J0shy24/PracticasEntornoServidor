<?php
//fichero
define('FICHERO','./misaldo.txt');
//abrir fichero y escribir 0 si no hay saldo.
$file=@fopen(FICHERO,'r+') or die("Error acceder al fichero");
$fileContent=file_get_contents(FICHERO);


//mensaje 
$msg="";

//Si existe el cookie token, y si el cookie token es divisible por 401
if(isset($_COOKIE['token'])&&($_COOKIE['token']%410==0)){
    //Si el importe está puesto y mayor que 0 y el submit es Ingreso 
    if(isset($_POST['importe'])&&$_POST['Orden']=="Ingreso"&&$_POST['importe']>0){
        file_put_contents(FICHERO,$_POST['importe']+intval($fileContent));
        $msg='Proceso realizada';
        header("Location:accesso.php?msg=".urlencode($msg));
        return;

    }//Si no está puesto ningun numero en el importe, o es menor o igual que 0 y el boton es ingreso
    else if((!isset($_POST['importe'])||$_POST['importe']<=0)&&$_POST['Orden']=="Ingreso"){
        $msg='Importe Erroneo o Importe menor o igual que 0';
        header("Location:accesso.php?msg=".urlencode($msg));
        return;
    }
    //Reintegro
    if(isset($_POST['importe'])&&$_POST['Orden']=='Reintegro'&&($_POST['importe']<=intval($fileContent))&&$_POST['importe']>0){
        $num=intval($fileContent)-$_POST['importe'];
        file_put_contents(FICHERO,$num);
        $msg='Proceso realizada';
        header("Location:accesso.php?msg=".urlencode($msg));
        return;
    }else if((!isset($_POST['importe'])||$_POST['importe']>$fileContent||$_POST['importe']<=0)&&$_POST['Orden']=='Reintegro') {
        $msg='Importe Erroneo o Importe mayor que el saldo';
        header("Location:accesso.php?msg=".urlencode($msg));
        return;
    }
    //Ver Saldo
    if($_POST['Orden']=="Ver saldo"){
        if($fileContent==""){
            $fileContent=0;
        }
        $msg="Su saldo actual es de  $fileContent Euros";
        header("Location:accesso.php?msg=".urlencode($msg));
        return;
    }
}else{
    $msg="Error de accesso";
    header("Location:accesso.php?msg=".urlencode($msg));
}
?>