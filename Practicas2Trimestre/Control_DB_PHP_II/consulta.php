<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,tr,td,th { border: 1px white solid;
        padding:10px;}
    </style>
</head>
<body>
    <?php
    include 'AccesoDatos.php';
    include 'Producto.php';
    $db=AccesoDatos::getModelo();
    
    $tabla=[];
    if(isset($_REQUEST['orden'])&&!isset($_COOKIE['hecho'])){

        setcookie('hecho',1,time()+(60*60*24));
        if(isset($_REQUEST['checkbox'])){
            foreach($_REQUEST['checkbox'] as $arr=>$val){
                array_push($tabla,$val);
            }
            $db->bajarPrecio($tabla);
        } 
    }

    $productos=$db->getProductos();
    ?>

    <h1>Bajar Precios</h1>
    <form method="get">
    <?php
    
    echo "<table>";
    $cabecera=false;
    foreach ($productos as $fila){
        // Genero los campos de la caberas de la tabla
        if (!$cabecera){
            echo "<tr>";
                echo "<td></td>";
            foreach($fila as $clave => $valor){
                echo "<th> $clave </th>";
            }
            echo "</tr>";
            $cabecera=true;
        }
        echo "<tr>";
        echo "<td><input type='checkbox' name='checkbox[]' value='".$fila['PRODUCTO_NO']."'></td>";
        foreach($fila as $valor){
            echo "<td> $valor </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
 ?>
    </table>
    <button type="submit" name="orden" value="procesar">Procesar</button>
</form>
</body>
</html>