<?php
// IF
$x = 30;
$y = 20;

if ($x > $y){
    echo "{$x} is größer als {$y}" . '<br>';
} else {
    echo "{$x} is kleiner als {$y}" . '<br>';
}
echo "-------------------------------------" . '<br>';
// ELSE-IF
$alter = 30;
if ($alter < 12){
    echo 'Sie sind ein Kind' . '<br>';
} elseif ($alter < 18){
    echo 'Sie sind ein Jungendlicher' . '<br>';
} elseif ($alter < 27){
    echo 'Sie sind ein junger Erwachsener' . '<br>';
} else {
    echo 'Sie sind Erwachsen' . '<br>';
}

// Verknüpfungen
$alter = 24;
if ($alter >= 18 && $alter <= 27){
    echo 'Kanditat ist für ein Stipendiumm zugelassen' . '<br>';
}else{
    echo 'Kanditat ist leider nicht zugelassen' . '<br>';
}

$ort = 'Graz';
if ($ort === 'Graz' || $ort === 'Wien' || $ort === 'Linz'){
    echo 'Sie wohnen in einer Landeshauptstadt' . '<br>';
}else{
    echo 'Sie wohnen am Land ;P' . '<br>';
}