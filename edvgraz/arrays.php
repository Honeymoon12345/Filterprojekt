<?php
$mixed_colors = array("orange", "purple", "green");
$base_colors = ["red", "yellow", "blue"];
echo "{$base_colors[0]} + {$base_colors[1]} = {$mixed_colors[0]} <br>";

$base_colors[] = 'pink';
$base_colors[] = 'orange';
$mixed_colors[] = 'salmon';
echo "{$base_colors[3]} + {$base_colors[4]} = {$mixed_colors[3]} <br>";

$kurse = [
    "PHP" => 5,
    "HTML" => 3,
    "CSS" => 2
];
echo "Im Kurs PHP sind {$kurse['PHP']} Teilnehmer angemeldet. <br>";

$personen = [
    'Max' => 25,
    'Anna' => 23,
    'Peter' => 30,
    'Lisa' => 28
];
foreach ($personen as $name => $alter){
    echo "Die Person {$name} ist {$alter} Jahre alt. <br>";
}
$summe = 1;
$numbers = [23, 89, 45, 67, 34, 78, 55, 12, 90, 67];
for ($i = 0; $i < count($numbers); $i++){
    $summe *= $numbers[$i];
}
echo $summe;