<?php
$frutas=[];


if(isset($_REQUEST['orden'])){

if(isset($_REQUEST['listafrutas'])&&$_REQUEST['orden']=="cambiar"){
    $frutas=$_REQUEST['listafrutas'];
    setcookie('galletadefrutas',implode(',',$frutas),time()+(60*60*24*7));
}else if($_REQUEST['orden']=="cambiar"){
    if(isset($_COOKIE['galletadefrutas'])){
        $frutas=explode(',',$_COOKIE['galletadefrutas']);
    }
    echo $_COOKIE['galletadefrutas'];

    
}


if($_REQUEST['orden']=="borrar") {
    setcookie('galletadefrutas',implode(',',$frutas),time()-1000000);
}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> las frutas </title>
</head>
<body>
<form>
<fieldset>
<legend>Sus frutas preferidas </legend>
<label for="nombre">Lista de frutas:</label><br>
<select name="listafrutas[]" multiple >
<option value="Platano" <?=in_array("Platano",$frutas) ? 'selected="selected"':""?>>Platano</option>
<option value="fresa" <?=in_array("fresa",$frutas) ? 'selected="selected"':""?>>fresa</option>
<option value="Naranja" <?=in_array("Naranja",$frutas) ? 'selected="selected"':""?>>Naranja</option>
<option value="Melón" <?=in_array("Melón",$frutas) ? 'selected="selected"':""?>>Melón</option>
<option value="Manzana" <?=in_array("Manzana",$frutas) ? 'selected="selected"':""?>>Manzana</option>
</select>
<button name="orden" value="cambiar"> Cambiar </button>
<button name="orden" value="borrar"> Borrar </button>
</fieldset>
</form>
</body>
</html>
