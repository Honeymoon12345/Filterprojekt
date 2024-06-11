<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arrays</title>
</head>
<body>
<?php
/* ----------------------------------------
		Hier beginnt die Übung D1
* ---------------------------------------- */
$zahlen = [ 55, 23, 12, 42, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ];
for ($i = 0; $i < count($zahlen); $i++){
	$summe += $zahlen[$i];
}
$mittelwert = $summe / count($zahlen);
echo 'Summe / Anzahl <br>';
echo $summe . ' / ' . count($zahlen) . '<br>';
echo 'Der Mittelwert beträgt: ' . $mittelwert . '<br> <br>';
/* ----------------------------------------
	   Hier endet die Übung D1
* ---------------------------------------- */

/* ----------------------------------------
		Hier beginnt die Übung D2
* ---------------------------------------- */
$viele_zahlen = [
	55,
	23,
	12,
	42,
	8,
	9,
	10,
	11,
	12,
	13,
	14,
	15,
	16,
	17,
	18,
	55,
	23,
	12,
	42,
	8,
	9,
	10,
	11,
	12,
	13,
	14,
	15,
	16,
	17,
	18,
	55,
	23,
	12,
	42,
	8,
	9,
	10,
	11,
	12,
	13,
	14,
	15,
	16,
	17,
	18,
	55,
	23,
	12,
	42,
	8,
	9,
	10,
	11,
	12,
	13,
	14,
	15,
	16,
	17,
	18
];

foreach ($viele_zahlen as $zahl) {
	if ($zahl == 8){
		$count++;
	}
}
echo $count . '<br> <br>';
/* ----------------------------------------
	   Hier endet die Übung D2
* ---------------------------------------- */

/* ----------------------------------------
		Hier beginnt die Übung D3
* ---------------------------------------- */
$daten = [
	'Name'    => 'Susanne Musterfrau',
	'Alter'   => 25,
	'Beruf'   => 'Programmiererin',
	'Wohnort' => 'Musterstadt'
]; 

$keys = [];
$values = [];
foreach ($daten as $key => $data){
	$keys[] = $key;
	$values[] = $data;
}
echo '<pre>';
print_r($keys);
print_r($values);
echo '<pre>';

/* ----------------------------------------
	   Hier endet die Übung D3
* ---------------------------------------- */
?>
</body>
</html>