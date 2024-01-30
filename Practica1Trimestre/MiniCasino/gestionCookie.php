<?php
$visita=0;
    
    if(isset($_COOKIE['visita'])){
        $visita=$_COOKIE['visita']; 
        setcookie('visita',$visita,time()+(60*60*24*30)); 
    }
    $visita++;
    setcookie('visita',$visita,time()+(60*60*24*30));
?>