<?php
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