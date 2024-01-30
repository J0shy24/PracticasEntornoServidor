<?php
$arrA=["uno","dos","tres","cuatro","cinco","seis","siete","ocho","nueve","diez"];
$arrB=[];

for($i=1;$i<=count($arrA);$i++){
    $arrC=[];
    for($y=1;$y<=count($arrA);$y++){
        $num=$y*$i;
        array_push($arrC,$num);

    }
    array_push($arrB,$arrC);
}
$arrA=array_combine($arrA,$arrB);

echo "<pre>";
        print_r($arrA);
echo "</pre>";
?>