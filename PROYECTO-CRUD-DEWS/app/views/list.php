
<form style="display:inline">
<button type="submit" name="orden" value="Nuevo" style="display:inline"> Cliente Nuevo </button><br>
<button type="submit" name="orden" value="NuevoUsuario" style="display:inline"> Usuario Nuevo </button><br>
</form>
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
<td><a href="#" onclick="confirmarBorrar('<?=$valor->first_name?>',<?=$valor->id?>);" >Borrar</a></td>
<td><a href="?orden=Modificar&id=<?=$valor->id?>">Modificar</a></td>
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
</form>
