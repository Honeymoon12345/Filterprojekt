<?php

$card_deck = [
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10, [1, 11]],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10, [1, 11]],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10, [1, 11]],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10, [1, 11]],
];

function get_random_card(&$card_deck)
{
    $randomIndex = array_rand($card_deck); //array card_deck aussen
    $innerRandomIndex = array_rand($card_deck[$randomIndex]); //array card_deck innen
    $randomNumber = array_splice($card_deck[$randomIndex], $card_deck[$randomIndex][$innerRandomIndex], 1); //zahl wird gefunden und gelöscht
    return $randomNumber;
}
/* $a = get_random_card($card_deck);
var_dump($a);
echo '<pre>';
var_dump($card_deck);
echo '</pre>'; */

function dealCards(){
    global $card_deck;
    echo '<pre>';
    var_dump($card_deck);
    get_random_card($card_deck);
    get_random_card($card_deck);
}
/*  foreach ($card_deck as $cards) {
     echo '<pre>';
     print_r($cards);
 } */
$player_cards[] = dealCards();
$dealer_cards[] = dealCards();
echo '<pre>';
print_r($player_cards);
print_r($dealer_cards);

function who_won($player_cards, $dealer_cards){
    
}