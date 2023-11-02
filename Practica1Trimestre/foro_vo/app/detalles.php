<?php 
$comment=$_REQUEST['comentario'];
?>
<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen($comment) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?=contarPalabras($comment);?></td></tr>
<tr><td>Letra + repetida:  </td><td><?=letraMasRepetida($comment);?></td></tr>
<tr><td>Palabra + repetida:</td><td><?=palabraMasRepetida($comment);?></td></tr>
</table>
</div>

