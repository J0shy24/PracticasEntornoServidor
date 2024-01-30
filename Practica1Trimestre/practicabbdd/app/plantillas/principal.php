<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>LISTADO DE CLIENTES</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container" >
<div id="header">
<h1>LISTADO DE CLIENTES versión 1.1 + BD (PDO)</h1>
</div>
<div id="content">
<?= $contenido ?>
<table>
    <tr>
        <th>id</th>
        <th>first_name</th>


    </tr>
</table>
<form>
<button name="orden" value="Nuevo"> Primero </button>
<button name="orden" value="Siguiente"> Siguiente </button>
<button name="orden" value="Anterior"> Anterior </button>
<button name="orden" value="Ultimo"> Ultimo </button>
</form>
</div>
</div>
</body>
