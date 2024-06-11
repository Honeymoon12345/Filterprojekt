<?php
//Berechne die Summe aller Zahlen

$zahlen = [5, 8, 7, 14, 5];


/*integer-Variable für die Summe
Summe auf 0 setzen
*/
$summe = 0;

//Jede Zahl von links nach recht ansehen
for($i = 0; $i < count($zahlen); $i++)
{
    $zahl = $zahlen[$i];
    // Zahl zur Summe addieren
    $summe = $summe + $zahl;
}

//Zahl der Summe addieren


//Nach der letzten Zahl Ergebnis
echo 'Summe der Zahlen: ' . $summe; 