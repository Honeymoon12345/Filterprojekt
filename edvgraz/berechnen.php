<?php
//Prozentrechnen
$ust = 0.2;
$netto = 10;
$umsatzst = $netto * $ust;
echo $umsatzst . '<br>';
$brutto = $umsatzst += $netto;
echo $brutto . '<br>' . '<br>';

//Durch 5 teilbar
$a = 4;
$b = 15;
echo $a % 5 . ' || ' . $b % 5 . '<br>' . '<br>';

//Meilen in Kilometer
$meilen = 89.98;
$km = 1.609344;
$ergebnis = $meilen * $km;
echo $ergebnis . '<br>' . '<br>';

// Temperatur umwandeln
$celsius = 40;
$fahreinheit = ($celsius * 9/5) + 32;
echo $fahreinheit;