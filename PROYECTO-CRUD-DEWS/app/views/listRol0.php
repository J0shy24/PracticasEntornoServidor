
<br>
<?php
    $cabeceras=["id","first_name","email","gender","ip_address","telefono"];

?>
<table>
<tr>
<?php foreach($cabeceras as $cabecera):?>
<th><a href="<?="?orden=Ordenar&valor=$cabecera"?>"><?=$cabecera?></a></th>
<?php endforeach;?>
</tr>
<?php foreach ($tvalores as $valor): ?>
<tr>
<td><?= $valor->id ?> </td>
<td><?= $valor->first_name ?> </td>
<td><?= $valor->email ?> </td>
<td><?= $valor->gender ?> </td>
<td><?= $valor->ip_address ?> </td>
<td><?= $valor->telefono ?> </td>


<td><a href="?orden=Detalles&id=<?=$valor->id?>" >Detalles</a></td>

<tr>
<?php endforeach ?>
</table>

<form>
<br>
<button type="submit" name="nav" value="Primero"> << </button>
<button type="submit" name="nav" value="Anterior"> < </button>
<button type="submit" name="nav" value="Siguiente"> > </button>
<button type="submit" name="nav" value="Ultimo"> >> </button>
<button type="submit" name="nav" value="desconectar">Cerrar Sesion</button>
</form>