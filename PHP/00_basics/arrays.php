<?php
/*
Array ist ein Datentyp für eine Variable.
In einem Array können, in einer Variable, null bis beliebig viele Werte gespeichert werden.
Ein Array erlaubt doppelte Einträge: ["Hansi", "Susi", "Rudi", "Susi"]

Was muss ich beim Erstellen eines neuen Arrays wissen?
name: wie nenne ich die Variable?
type: Datentyp der Variable --> steht fest: Array
initValues: welche Startwerte soll mein Array enthalten?

Code: $name = [initValues];

In einem Array hat jeder Eintrag (Element) einen eindeutigen Index
Das 1. Element im Array hat den Index 0, das 2. den Index 1, ...
--> Arrays sind Zero-Based!
*/

//Leeres Array, 0 Elemente
$a = [];

//Array mit Elementen
$numbers = [1, 2, 3, 4, 5];
$fruits = ['Apfel', 'Orange', 'Weintrauben', 'Birne'];

//Einfache Ausgabe
echo 'Ausgabe des Arrays mit print_r():<br>';
print_r($numbers);
echo '<br><br>';
print_r($fruits);
echo 'Anzahl der Elemente im $fruits:' . count($fruits) . '<br><br>';

/*Ein neues Element am Ende einfügen
$arr[] = wert;
*/
echo 'Einfügen von Mango: <br>';
$fruits[] = 'Mango';
print_r($fruits);
echo '<br><br>';

/* array_splice(): Wert an einem bestimmten Index einfügen
array_splice($arr, index, 0, insertVal);
*/
echo 'Einfügen von Erdbeere am Index 2:<br>';
array_splice($fruits, 2, 0, 'Erdbeere');
print_r($fruits);
echo '<br><br>';

/* Wert löschen
array_splice($arr, index, 1);
*/
echo 'Lösche 2. Element:<br>';
array_splice($fruits, 2, 1);
print_r($fruits);
echo '<br><br>';

/* sort($arr): Aufsteigend sortieren
*/
echo 'Aufsteigend sortieren:<br>';
sort($fruits);
print_r($fruits);
echo '<br><br>';

/* rsort($arr): Absteigend sortieren
*/
echo 'Absteigend sortieren:<br>';
rsort($fruits);
printArray($fruits);

/* Ein Element ersetzen
*/
echo 'Element ersetzen Index 0:<br>';
$fruits[0] = 'Banane';
printArray($fruits);

/* Einen Wert holen...
array: wie heißt die Array-Variable
index: welchen Index hat das gesuchte Element?
variable: auf welche Variable soll das (gefundene) Element gespeichert werden
Code: variable = array[index];
*/
echo 'Hole das Element am Index 1 und speichere es in der Variable $fruit<br>';
$fruit = $fruits[1];
echo $fruit;
echo '<br><br>';
printArray($fruits);

/* Über ein Array iterieren 
--> jedes Element der Reihe nach betrachten und etwas damit tun
laufvariable $i: Integer-Variable, steuert die Schleife
start: Integer-Startwert der Laufvariable am Anfang der Schleife (Index 0)
finish: Integer-Wert der Laufvariable am Ende der Schleife (Länge des Arrays)
change: Int-Wert der zur Laufvariable nach jedem Schleifendurchgang addiert wird (1)
loopbody: Code der wiederholt ausgeführt wird (Zugriff auf das Array-Element am Index $i)
*/
echo 'Iteration des Arrays:<br>';
for($i = 0; $i < count($fruits); $i++)
{
    $fruit = $fruits[$i];
    echo $fruit . ' ';
}


function printArray($arr)
{
    print_r($arr);
    echo '<br><br>';
}


?>