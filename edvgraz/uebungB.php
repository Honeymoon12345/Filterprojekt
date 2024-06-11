<?php
// Hier beginnt die Übung
echo 'B1 <br>';
for ($i = 0; $i <= 20; $i ++){
    echo 'Ich darf nicht im Flur Skateboard fahren ...!  <br>';
}

$summe = 0;
echo 'B2 <br>';
for ($i = 1; $i <= 10; $i ++){
    $summe += $i;
}
echo $summe . '<br>';

echo 'B3 <br>';
//$count = 100;
for ($i = 1000; $i >= 0; $i -= 100){
    echo $i . '<br>';
}