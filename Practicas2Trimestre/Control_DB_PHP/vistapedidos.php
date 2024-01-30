<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vistapedidos</title>
</head>
<body>
    <?php
        require_once("Cliente.php");
        require_once("Pedido.php");
    ?>

    <h1>Lista de Pedidos</h1>
    <h2>Bienvenido <?=$client->nombre?>. Has entrado <?=$client->veces?> Veces</h2>
    <h4>Esto es su lista de pedidos del cliente con código <?=$client->cod_cliente?></h4>
    <?php
        $total=0;
        if(count($pedidos)>0){
    ?>
    <table>
            <?php foreach($pedidos as $ped){?>
                <tr>
                    <td><?=$ped->producto?></td>
                    <td><?=$ped->precio?></td>
                </tr>
                <?php $total+=$ped->precio; }?>
                <tr>
                    <td>Total :</td>
                    <td><?=$total?></td>
                </tr>
    </table>
    <?php
        }else{
    ?>
        <p>No existen ningún pedidos para <?=$client->nombre?></p>
    <?php
        }
    ?>

<a href="acceso.html">
        <input type="submit" value="Volver">
    </a>
</body>
</html>