<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra Papel Tijeras</title>
    <style>
        body{
            background-color: whitesmoke;
        }
        table,tr,th,td{
            border: 1px black solid;
            font-size: 1.2em;
            padding: 10px;
            text-align: center;
        }
        tr,th,td{
            background-color: whitesmoke;
        }
        table {
            margin-left: auto;
            margin-right: auto;
            background-color: gold;
        }
        h1{
            text-align: center;
        }

    </style>
</head>
<body>
    <?php
    define ('PIEDRA1',  "&#x1F91C;");
    define ('PIEDRA2',  "&#x1F91B;");
    define ('TIJERAS',  "&#9986;");
    define ('PAPEL',    "&#x1F91A;" );

    //tabla Jugadores
    $tablaJugador=[PIEDRA1,PAPEL,TIJERAS];

    //0= Empate, 1=Ganar, 2=Perder
    //A base de la posición en la tabla : 0-> Piedra, 1->Papel,2->Tijeras
    $tablaGanador=[[0,2,1],[1,0,2],[2,1,0]];
    
    //Jugador 1 y 2
    $j1=random_int(0,2);
    $j2=random_int(0,2);

    //Funcion a base del jugador 1 y la tabla
    function generarGanador($p1,$p2,$tabla){
        $valorGanador=$tabla[$p1][$p2];
        return $valorGanador;
    }

    //mensaje dependiendo del resultado de la funcion
    $msg=["Empate!","Gana el Jugador 1!","Gana el Jugador 2!"];
    ?>

    <h1>Generador Piedra Papel o Tijeras</h1>
    <?php
       $winner=generarGanador($j1,$j2,$tablaGanador);
    ?>
    <table>
        <tr>
            <th>Jugador 1</th>
            <th>Jugador 2</th>
        </tr>

        <tr>
            <td><?php
            echo $tablaJugador[$j1];
            ?></td>
            <td><?php
            if ($j2==0){
                echo PIEDRA2;
            }
            else echo $tablaJugador[$j2];
            ?></td>
        </tr>
        <tr>
            <td colspan='2'>
                <?php
                echo $msg[$winner];
                ?>
            </td>
        </tr>
    </table>
</body>
</html>