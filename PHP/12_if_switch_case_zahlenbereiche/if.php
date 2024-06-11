<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <h1>Zahlenbereiche mit if</h1>
    <?php
    //Variable deklarieren
    $zahl; 

    //Variable initialisieren
    $zahl = 0;
    echo "<p>Die Zahl ist $zahl.</p>";

    if($zahl > 0 && $zahl <= 5){
    echo "<p>Die Zahl ist $zahl.</p>";
    } elseif ($zahl >= 6 && $zahl <= 10) {
        echo "<p>Die Zahl ist zwischen 6 - 10.</p>";
        if($zahl == 10){
        echo '<p>Jackpot</p>';}
    }elseif ($zahl == 0) {
        echo '<p>Keine 0!</p>';
    } else {
        echo'<p>Die Zahl ist zu groß/klein.</p>';
    }
    ?>
    
</body>
</html>