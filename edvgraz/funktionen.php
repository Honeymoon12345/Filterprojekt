<?php

// Aufgabe 1: Schreiben Sie eine Funktion die, die Summe aller geraden Zahlen aus dem Array $zahlen zurückgibt.
$zahlen = [23, 45, 66, 87, 199, 267, 2, 8, 89, 933];

function sum_even($zahlen)
{
    $summe = 0;
    foreach ($zahlen as $zahl) {
        if ($zahl % 2 == 0) {
            $summe += $zahl;
        }
    }
    return $summe;
}
echo sum_even($zahlen) . '<br><br>';

// Aufgabe 2: Schreiben Sie eine Funktion die, einen Buch ISBN-13 Code validiert.
function validate_isbn($isbn)
{
    $summe = 0;
    if (strlen($isbn) >= 13) {
        $isbn = str_replace('-', '', $isbn);
        echo $isbn . '<br>';
    }
    //Berechnung
    for ($i = 0; $i < 12; $i++) {
        if ($i % 2 == 0) {
            $summe += (int)$isbn[$i];
        } else {
            $summe += (int)$isbn[$i] * 3;
        }
    }
    //Rest
    $rest = $summe % 10;
    //Prüfzahl
    $pruefzahl = 10 - $rest;
    //prüfung der letzten Zahl mit der Prüfzahl
    if ($pruefzahl == substr($isbn, 12)) {
        echo 'true' . '<br>';
    } else {
        echo 'false' . '<br>';
    }
    //return $summe . '<br>';
}

echo validate_isbn('9783836283274') . '<br>';
echo validate_isbn('978-38362832-72') . '<br>';

// Aufgabe 3: Schreiben Sie die Funktion get_isbn_result, die die Gültigkeit einer ISBN-13 prüft und das Ergebnis als String zurückgibt.

// Aufgabe 4: Schreiben Sie eine Funktion, die das Array personal_data in ein assoziatives Array umwandelt.
$personal_data = ['Max', 'Mustermann', '1970-01-01', 'Musterstraße 1', '12345', 'Musterstadt'];

function to_assoc($personal_data)
{
    $keys = ['vorname', 'nachname', 'geburtstag', 'straße', 'plz', 'ort'];
    $result = array_combine($keys, $personal_data);
    return $result;
}
echo '<pre>';
print_r($personal_data);
var_dump(to_assoc($personal_data));     

// Aufgabe 5: Schreiben Sie eine Funktion, die ein Geburtsdatum erhält und die Anzahl der Tage bis zum heutigen Tag zurückgibt.

function daysUntilToday(){
    $now = new DateTime("now");
    $birthdate = new DateTime("1986-03-09"); 
    $days = $birthdate->diff($now);
    return $days->days;
}

echo daysUntilToday();


// Aufgabe 6: Schreiben Sie eine Funktion, die dem Array $students neuen Studenten hinzufügt. Die Übergabe des Arrays soll per Referenz erfolgen.

$students = [['name' => 'Susanne', 'age' => 23], ['name' => 'Max', 'age' => 25]];

function newStudent($student){
    global $students;
    array_push($students, $student);

}
newStudent(['name' => 'Anna', 'age' => 22]);
echo '<pre>';
echo newStudent(['name' => 'Anna2', 'age' => 22]);
print_r($students);

//Aufgabe 7: Schreiben Sie eine Funktion, die die Dateigröße eines Bildes berechnet und diese in MB zurückgibt. Die Funtkion erhält eine Auflösung als Parameter.
function img_size($width, $height){
  $color_deep = 24;
  $total_pixels = $width * $height * $color_deep;
  $total_mb = $total_pixels / (8 * 1024 * 1024);
  return number_format($total_mb, 2) . ' MB <br>';
}

echo img_size(1920, 1080);
// optionale Aufgabe 8 (schwer): Schreiben Sie eine Funktion, die das Array $students nach dem Namen sortiert. Das Array wird auch hier als Verweis übergeben.
function sort_students(){
    global $students;
    sort($students);
}
sort_students();
echo '<pre>';
print_r($students);