<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EjercicioDados</title>
    <style>
        body {
            text-align: center;
        }
        h1{
            font-size: 3.5em;
        }
        p {
            font-size: 3em;
        }
    </style>
</head>
<body>
    <?php
        $tablaDados=[1 =>"&#9856;" , 
        2 =>"&#9857;" , 
        3 =>"&#9858;",
        4 =>"&#9859;" , 
        5 =>"&#9860;", 
        6 =>"&#9861;"];

        function generarDados($tabla){
            $dadosGenerados="";
            $dadosPuntos=0;
            $valores=array_values($tabla);
            $puntos=array_keys($tabla);

            for ($i=0;$i<5;$i++){
                $ranD=random_int(0,5);
                $dadosGenerados.=$valores[$ranD];
                $dadosPuntos+=$puntos[$ranD];
            }
            return "$dadosGenerados $dadosPuntos Puntos";
        }
        
        $j1=generarDados($tablaDados);
        $j2=generarDados($tablaDados);
        $jugador1= intval(substr($j1,-9,2));
        $jugador2= intval(substr($j2,-9,2));
    ?>
    <h1>Generador de Dados</h1>
    <p>Jugador 1 : <?php echo $j1;?> </p>
    <p>Jugador 2 : <?php echo $j2;?></p>
    <p>Resultado :  <?php if ($jugador1>$jugador2){
        echo " Ganó el Jugador 1!";} else if ($jugador2>$jugador1){  echo " Ganó Jugador 2!";
        } else {echo "Empate!";}?></p>

    
</body>
</html>