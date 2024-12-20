<?php
function allCards(){
  return $cards = [
    ["H",1],["H",2],["H",3],["H",4],["H",5],["H",6],
    ["D",1],["D",2],["D",3],["D",4],["D",5],["D",6]
  ];
}
function shuffleCards($cards){
  $shuffleCards = [];
  $times = count($cards);
  for ($i = 0; $i < $times; $i++) {
    $index = rand(0, $times-1-$i);
    list($cards, $shuffleCards) = moveCard($cards, $shuffleCards, $index);
  }
  return $shuffleCards;
}
function showNum($card){
  return $card[1]."\n";
}
function showSuit($card){
  return $card[0]."\n";
}
function showCard($card){
  return $card[0].$card[1]."\n";
}
function showCards($cards){
  $output = "";
  foreach ($cards as $card) {
    $output .= $card[0].$card[1].",";
  }
  return $output =  rtrim($output, ",")."\n";
}
function addCard($cards,$card){
  array_push($cards, $card);
  return $cards;
}
function removeCard($cards,$index){
  array_splice($cards, $index, 1);
  return $cards;
}
function moveCard($fromCards, $toCards, $index){
  $moveCard = array_splice($fromCards, $index, 1)[0];
  array_push($toCards, $moveCard);
  return [$fromCards, $toCards];
}
function isValidCards($cards){
  $allowedSuits = [ "H", "D", "S", "C" ];
  foreach ($cards as $card) {
    if (
      in_array($card[0], $allowedSuits, true) 
      && $card[1] < 13) {
      } else {
        return false;
      }
    }
  return true;
}
function getSuitName($card) {
  $suitNames = [
      'H' => 'Heart',
      'C' => 'Club',
      'D' => 'Diamond',
      'S' => 'Spade'
  ];
  return $suitNames[$card[0]] ?? 'Unknown';
}
// $card = ["H",1];
// echo getSuitName($card);

?>