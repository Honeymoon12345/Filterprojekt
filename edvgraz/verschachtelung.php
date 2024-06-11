<?php
$personen = [
    [
        "name" => "Max",
        "alter" => 25,
        "wohnort" => "Musterstadt"
    ],
    [
        "name" => "Erika",
        "alter" => 30,
        "wohnort" => "Musterstadt"
    ],
    [
        "name" => "Susanne",
        "alter" => 28,
        "wohnort" => "Musterstadt"
    ]
];

foreach ($personen as $person) {
    if ( $person["alter"] < 30){
        echo $person["name"] . "<br>";
    }
}

$random_nums = [
    [5, 6, 19],
    [22, 98, 3],
    [7, 36, 45]
];

$max = $random_nums[0][0];
foreach ($random_nums as $nums){
    foreach ($nums as $num){
        if ($num > $max){
            $max = $num;
        }
    }
}
echo "Max Number: " . $max;