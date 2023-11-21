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
     <option value="Java">Java</option>    
     <option value="Javascripts">Javascripts</option>
     <option value="Php">Php</option>
     <option value="Python">Python</option>
     <option value="Perl">Perl</option>
     <option value="C#">C#</option>
     </select><br>
<input type="submit" value="Enviar">
</fieldset>
</form>
</body>
</html>
