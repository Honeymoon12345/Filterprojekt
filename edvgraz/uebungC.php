<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Übung C - Schleifen</title>
</head>
<body>
<h2>Übung C1 - Zahlenausgeben</h2>
<form action="uebungC.php" method="post">
    <label for="start">Startwert:
        <input type="number" id="start" name="start">
    </label>
    <label for="end">Endwert:
        <input type="number" id="end" name="end">
    </label>
    <input type="submit" value="Zahlen ausgeben">
</form>
<?php
if ( isset( $_POST['start'] ) && isset( $_POST['end'] ) ) {
	$start = $_POST['start'];
	$end   = $_POST['end'];
    $zahl = 1;
    /* ----------------------------------------
				Hier beginnt die Übung C1
    * ---------------------------------------- */
    for ($i = $start; $i <= $end; $i ++){
        echo $i . "<br>";
    }
    /* ----------------------------------------
			Hier endet die Übung C1
    * ---------------------------------------- */


}
?>
<h2>Übung C2 - Teilbar</h2>
<form action="uebungC.php" method="post">
    <label for="start_c2">Startwert:
        <input type="number" id="start_c2" name="start_c2">
    </label>
    <label for="end_c2">Endwert:
        <input type="number" id="end_c2" name="end_c2">
    </label>
    <input type="submit" value="Durch 10 teilbar">
</form>
<?php
if ( isset( $_POST['start_c2'] ) && isset( $_POST['end_c2'] ) ) {
	$start_c2 = $_POST['start_c2'];
	$end_c2   = $_POST['end_c2'];
    //$zahl_c2 = 0;
	/* ----------------------------------------
				Hier beginnt die Übung C2
    * ---------------------------------------- */
     for ($i = $start_c2; $i <= $end_c2; $i ++){
        if ($i % 10 == 0) {
            echo $i . "<br>";
        }
     }
	/* ----------------------------------------
			Hier endet die Übung C2
    * ---------------------------------------- */

}
?>
<h2>Übung C3 - Fakultät</h2>
<form action="uebungC.php" method="post">
    <label for="fak">Fakultät von:
        <input type="number" id="fak" name="fak">
    </label>
    <input type="submit" value="Fakultät berechnen">
</form>
<?php
if ( isset( $_POST['fak'] ) ) {
	$fak = $_POST['fak'];
	/* ----------------------------------------
		Hier beginnt die Übung C3
    * ---------------------------------------- */
    /* do {
        $zahl = $fak * $fak;
        echo $zahl;
    }while ($fak!); */

    /* while ($fak!){
        $fak **;
        echo $fak;
        $fak++;
    } */
    $zahl = 1;
    for ($i = 1; $i <= (int)$fak; $i++){        
        $zahl *= $i;   
    }
    echo "Die Fakultät ist: {$zahl}";
	/* ----------------------------------------
		Hier endet die Übung C3
    * ---------------------------------------- */
}
?>
</body>
</html>