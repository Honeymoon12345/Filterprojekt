<?php
/* for ($i = 0; $i < 100; $i --){
    echo $i . '<br>';
}

for ($i = 0; $i < 5; $i ++){
    echo "<button> Ich bin Btn Nr {$i}</button>";
} */

$summe = 0;
while ($summe < 100){
    $summe += rand(1, 10);
    echo 'Summe Zufallszahlen:' . $summe . '<br>';
}