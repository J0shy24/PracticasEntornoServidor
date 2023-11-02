<?php
//Entrada
function usuarioOk($usuario, $contraseña) :bool {
   $resu=false;
   $contr="";

   if(strlen($usuario)==0){}
   else {
      for($i=strlen($usuario)-1;$i>=0;$i--){
         $letra=$usuario[$i];
         $contr.=$letra;
      }
    if(strlen($usuario)>=8 && ($contraseña==$contr)){
      $resu=true;
    }
   }
   return $resu;
}

//Comentario
function contarPalabras($comment){
   if(strlen($comment)==0){
      return 0;
   }
   $arrayComment=explode(" ",$comment);
   $resu=count($arrayComment);

   return $resu;
}

function letraMasRepetida($comment){
   if (strlen($comment)==0){
      return null;
   }
   $resu="null";
   $contador1=0;
   $letraCogida=[];
   for($i=0;$i<strlen($comment);$i++){
      $contador2=0;
      $letra=$comment[$i];
      if($resu==""){
         $resu=$letra;
      }
         for($y=0;$y<strlen($comment);$y++){
            $letraProbar=$comment[$y];
            if(in_array($letra,$letraCogida)){
               break;
            }else {
               if($letraProbar==$letra){
                  $contador2++;
               }
            }
         }
      if ($contador2>$contador1){
         $resu=$letra;
         $contador1=$contador2;
      }
      array_push($letraCogida,$letra);
   }
   return $resu;
}

function palabraMasRepetida($comment){
   if (strlen($comment)==0){
      return null;
   }
   $resu="null";
   $arrayComment=explode(" ",$comment);
   $palabraCogido=[];
   
   for ($i=0;$i<count($arrayComment);$i++){
      $palabra=$arrayComment[$i];
      $contador1=0;
      if($resu==""){
         $resu=$palabra;
      }else{
         for($y=0;$y<count($arrayComment);$y++){
            $contador2=0;
            $palabraProbar=$arrayComment[$y];
            if(in_array($palabraProbar,$palabraCogido)){
               break;
            }else
            if($palabra==$palabraProbar){
               $contador2++;
            }
         }
         if($contador2>$contador1){
            $resu=$palabra;
            $contador1=$contador2;
         }

         array_push($palabraCogido,$palabra);
      }
   }

   return $resu;
}