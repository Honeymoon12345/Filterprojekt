<?php
// Name
$vvorname = 'Marlene';
echo "Name" . '<br>';
echo $vvorname  . '<br>' . '<br>';

// Datentypen
$integer_zahl = 10;
$double_zahl = 10.5;
$bool_wert = true;
$string_wert = 'Hallo Welt';
$noch_n_string = '67';

echo gettype($integer_zahl) . '<br>';
echo gettype($double_zahl) . '<br>';

echo var_dump($bool_wert) . '<br>';
echo var_dump($string_wert) . '<br>';
echo var_dump($noch_n_string) . '<br>' . '<br>';

// Adresse
$vorname = 'Marlene';
$nachname = 'Pucher';
$strasse = 'Schinitzgasse 5a';
$plz = 8605;
$ort = 'Kapfenberg';

echo $vorname . " " . $nachname . '<br>';
echo $strasse . '<br>';
echo $plz . " " . $ort . '<br>' . '<br>';


// rechnen
$a = 10;
$b = 20;
$ergebnis = 0;

echo "Rechnungen" . '<br>';
$a++;
echo $a . '<br>';
$b--;
echo $b . '<br>';
$ergebnis = $a + $b;
echo $ergebnis . '<br>';
$ergebnis *= $a;
echo $ergebnis . '<br>';
echo $a % $b . '<br>';
$exponent_erg = $a ** 2;
echo $exponent_erg . '<br>';
echo $exponent_erg += $ergebnis . '<br>';

