<?php
$isbn = '9-783836283274';
$summe = 0;

//Wenn mit Bindestrich geschrieben
echo $isbn . '<br>';
if ($isbn >= 13){
    $isbn = str_replace('-', '', $isbn);
    echo $isbn . '<br>';
}
//Berechnung
for ($i = 0; $i < 12; $i ++){
    if ($i % 2 == 0){ 
        $summe += (int)$isbn[$i];
    }else {
        $summe += (int)$isbn[$i] * 3;
    }    
}
echo 'Summe: ' . $summe . '<br>';
//Rest
$rest = $summe % 10;
echo 'Rest: ' . $rest . '<br>';
//Prüfzahl
$pruefzahl = 10 - $rest;
echo 'Prüfzahl : ' . $pruefzahl . ' | ' . substr($isbn, 12) . '<br>';
//prüfung der letzten Zahl mit der Prüfzahl
if ($pruefzahl == substr($isbn, 12)){
    echo 'Die Zahl stimmt überein! <br>';
}else{
    echo 'Die Zahl stimmt nicht überein!! <br>';
}


