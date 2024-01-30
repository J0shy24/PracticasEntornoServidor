<?php
require_once("BiciElectrica.php");


function cargarbicis(){

    $arr_bicis=[];
    if(($csv_file=fopen("Bicis.csv","r"))){
        while(($linea=fgetcsv($csv_file))){
            $csv_id=$linea[0];
            $csv_coordx=$linea[1];
            $csv_coordy=$linea[2];
            $csv_bateria=$linea[3];
            $csv_estado=$linea[4];

            array_push($arr_bicis,new BiciElectrica($csv_id,$csv_coordx,$csv_coordy,$csv_bateria,$csv_estado));
        }

        fclose($csv_file);
    }

    return $arr_bicis;
}

function mostrartablabicis(){
    $propiedades=["id","coordx","coordy","bateria"];
    $bicis=cargarbicis();
    $resu="";

    $resu.="<table border='1px black solid'>";
      
        $resu.="<tr>";
        for($i=0;$i<count($propiedades);$i++){  
            $resu.="<th>".$propiedades[$i]."</th>";
        }
        $resu.="</tr>";
      
      for($i=0;$i<count($bicis);$i++){  

        if($bicis[$i]->operativa){
        $resu.="<tr>";
            for($y=0;$y<count($propiedades);$y++){
                if($y!=3){
                    $resu.="<td>".$bicis[$i]->{$propiedades[$y]}."</td>";
                }else {
                    $resu.="<td>".$bicis[$i]->{$propiedades[$y]}.'  %'."</td>";
                }
                
                
            }
        $resu.="</tr>";
        }
      }
    $resu.="</table>";

    return $resu;
}


function bicimascercana($x,$y){
    $bicis=cargarbicis();
    $bicis1=[];
    $distancia=[];

    for($i=0;$i<count($bicis);$i++){
        if($bicis[$i]->operativa){
            array_push($bicis1,$bicis[$i]);
        }
    }

    for($i=0;$i<count($bicis1);$i++){
        array_push($distancia,$bicis1[$i]->distancia($x,$y));
    }

    $distancia=array_combine($bicis1,$distancia);

    asort($distancia);
    return key($distancia);
    
}
?>