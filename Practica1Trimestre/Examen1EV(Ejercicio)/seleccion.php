<?php
session_start();
$lenguajes=[];

if(isset($_POST['lenguajes'])){
    $lenguajes=$_POST['lenguajes'];
}
$_SESSION['lenguajes']=$lenguajes;

print_r($lenguajes);
echo "<br>";
print_r ($_SESSION['lenguajes']);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Selección de personal</title>
</head>
<body>
<h2> Datos de candidato: Paso 2º </h2>
<form  action="seleccion.php" method="POST">
<fieldset>
	<legend>Datos Profesionales </legend>
Lenguajes de programación:<br>
<select name="lenguajes[]" multiple="multiple" size=6>
     <option value="Java" <?=in_array("Java",$_SESSION['lenguajes']) ? 'selected="selected"':"" ?>>Java</option>    
     <option value="Javascripts" <?=in_array("Javascripts",$_SESSION['lenguajes'])? 'selected="selected"':"" ?>>Javascripts</option>
     <option value="Php" <?=in_array("Php",$_SESSION['lenguajes'])? 'selected="selected"':"" ?>>Php</option>
     <option value="Python" <?=in_array("Python",$_SESSION['lenguajes'])? 'selected="selected"':"" ?>>Python</option>
     <option value="Perl" <?=in_array("Perl",$_SESSION['lenguajes'])? 'selected="selected"':"" ?>>Perl</option>
     <option value="C#" <?=in_array("C#",$_SESSION['lenguajes'])? 'selected="selected"':"" ?>>C#</option>
     </select><br>
<input type="submit" value="Enviar">
</fieldset>
</form>
</body>
</html>