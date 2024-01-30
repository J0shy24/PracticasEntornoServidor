<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    if (!empty($_SESSION['fruitTable'])){
?> 
   <table style="border:1px solid black">
                 <?php
                        echo "<b>HAS COMPRADO :</b>";
                        foreach ($_SESSION['fruitTable'] as $value => $key) {
                            echo "<tr> <td>";
                            echo $value . " " . $key;
                            echo "</td> </tr>";
                        }
                    ?> 
            </table>
            <?php
    }   
?> 
</body>
</html>