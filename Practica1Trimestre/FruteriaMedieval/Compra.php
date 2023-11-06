
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>LA FRUTERIA</title>
</head>
<body>

<?php 
    if(isset($_POST['button'])){
        $boton=$_POST['button'];
        $action="";
        if($boton=="terminar"){
            $action="./Despedido.php";
        }else {
           $action=$_SERVER['PHP_SELF'];
        }

        die($action);
    }
?>
<H1> La Frutería del siglo XXI</H1>
<b>Cesta:</b>
<table>
    <tr>

    </tr>
</table>
<B>BIENVENIDO <?=$_SESSION['nombre'];?> HAZ TU COMPRA</B><br>
<form action="<?echo $action;?>" method="post">
    <label>Fruta :</label><select name="fruta">
        <option value="naranja">Naranja</option>
        <option value="platano">Platano</option>
        <option value="mango">Mango</option>
        <option value="kaki">Kaki</option>
    </select>
    <label> Cantidad :</label>
    <input type="number" value="0" size="4" min="0" name="cantidad">
    <button value="añadir" name="button" type="submit">Añadir</button>
    <button value="terminar" name="button" type="submit">Terminar</button>
</form>
    

<?php
    if (empty($_SESSION['fruitTable'])){
    $_SESSION['fruitTable']=array();
    }


    if(isset($_POST['fruta'])&&isset($_POST['cantidad'])&&isset($_POST['button'])){
       if($_POST['button']=="terminar"){
        echo "TERMINAR";
        header("./Despedido.php");
       } else{
        echo "AÑADIR";
        $fruit=$_POST['fruta'];
        $quant=$_POST['cantidad'];
        añadir($fruit,$quant,$_SESSION['fruitTable']);
        print_r($_SESSION['fruitTable']);
       }
    } 

    function añadir($nomFruta,$numCant,&$tablaArray){
        if (array_key_exists($nomFruta,$tablaArray)){
            $valor=$tablaArray[$nomFruta];
            $tablaArray[$nomFruta]=$valor+$numCant;
        }else{
            $tablaArray[$nomFruta]=$numCant;
        }
    }
 ?>
</body>
</html>