<?php
include "helper/card-funcs.php";

$playerNumber = 3;

$finishedCards = []; //すて杯
$choicedCards = []; //移動用配列
$lastCards = []; //出されているカード
$turnTotal = 0; //ターン回数
$turnArray = setTurnArray();
$No = array_search("turn", $turnArray);

$cards = allCards(); //全カード用意
$cards = shuffleCards($cards); //シャッフル
$playersCards = dealCards($cards, $playerNumber); //配る


while(isNotEnd()){

  pushAnyCard(); //何でも出す
  rewriteTurn();
  isNotEnd();
  
  while(isContenu($turnArray)){
    pushCard();
  }

  // 流れた
  list($lastCards, $finishedCards) = moveCard($lastCards, $finishedCards, 0);
}
exit(0); //ゲーム終了

// 以下関数

function rewriteTurn() {
  global $turnArray, $playerNumber, $playersCards;
  // ターン書き換え(上がりの場合)
  $No = array_search("turn", $turnArray);
  if (empty($playersCards[$No])){
    echo "Player".$No."さんは上がりです。";
    $turnArray = array_replace($turnArray, [$No => "finished"]);
    for ( $i=0; $i<$playerNumber-1; $i++ ) {
      $NextNo = ( $No + $i + 1) % $playerNumber;
      if ($turnArray[$NextNo] != "finished"){
        $turnArray = array_replace($turnArray, [$NextNo => "turn"]);
        break;
      }
    }
    for ( $i=0; $i<$playerNumber-1; $i++ ) {
      $NextNo = ( $No + $i + 1) % $playerNumber;
      if ($turnArray[$NextNo] == "pass"){
        $turnArray = array_replace($turnArray, [$NextNo => "wait"]);
        break;
      }
    }
  } else { // ターン書き換え(上がりでない場合)
    $turnArray = array_replace($turnArray, [$No => "wait"]);
    for ( $i=0; $i<$playerNumber-1; $i++ ) {
      $NextNo = ( $No + $i + 1) % $playerNumber;
      if ($turnArray[$NextNo] != "finished"){
        $turnArray = array_replace($turnArray, [$NextNo => "turn"]);
        break;
      }
    }
  }
}

function isNotEnd(){
  global $playerNumber, $turnArray;
  $NumOfFinishedPlayers = count(array_filter($turnArray, function($turn) {
    return $turn === "finished";
    }));
  if ($NumOfFinishedPlayers > $playerNumber-2){
    echo "ゲーム終了\n";
    exit(0);
  } else {
    echo "ゲーム続行\n";
    return true;
  }
} 

function setTurnArray(){
  global $playerNumber;
  $turnArray = [];
  for ($i = 0; $i < $playerNumber; $i++) {
    if ($i == 0) {
      array_push($turnArray, "turn");
    } else {
      array_push($turnArray, "wait");
    }
  }
  return $turnArray;
}

function pushAnyCard() {
  global $lastCards, $playersCards, $choicedCards, $lastCards, $turnArray;
  $No = array_search("turn", $turnArray);
  echo "-----------------"."\n";
  echo "Player".$No."さんの番です。";
  echo "何枚目のカードを出しますか？ :";
  showCards($playersCards[$No]);
  $index = (int)fgets(STDIN);
  list($playersCards[$No], $choicedCards) = moveCard($playersCards[$No], $choicedCards, $index);
  list($choicedCards, $lastCards) = moveCard($choicedCards, $lastCards, 0);
}

function pushCard() {
  global $lastCards, $playersCards, $choicedCards, $lastCards, $finishedCards, $turnArray;
  $index = 0;
  do {
    $No = array_search("turn", $turnArray);
    echo "-----------------"."\n";
    echo "Player".$No."さんの番です。";
    echo "今出ているカード :"; showCards($lastCards);
    echo "あなたの手持ち :"; showCards($playersCards[$No]);

    // パス確認
    echo "何枚目のカードを出しますか？\nパスの場合は99を入力:\n";
    echo "-----------------";
    $index = (int)fgets(STDIN);
    // パスの場合
    if ($index==99){
      passAndNextTurn();
      break; 
    }
    // 出す場合
    $isStronger = ($playersCards[$No][$index][1]>$lastCards[0][1]);
    if (!$isStronger){ 
      echo "カードが弱いため出せません。"."\n";
      echo "-----------------"."\n";
    } else {
      echo "カードを出せます"."\n";
      list($lastCards, $finishedCards) = moveCard($lastCards, $finishedCards, 0);
      list($playersCards[$No], $lastCards) = moveCard($playersCards[$No], $lastCards, $index);
      rewriteTurn();
      isNotEnd();
    }
  } while (!$isStronger);
}

function passAndNextTurn() {
  global $turnArray, $playerNumber;
  $No =  array_search("turn", $turnArray);
  $turnArray = array_replace($turnArray, [$No => "pass"]);
  for ( $i=0; $i<$playerNumber-1; $i++ ) {
    $NextNo = ( $No + $i + 1) % $playerNumber;
    if ($turnArray[$NextNo] != "finished"){
      $turnArray = array_replace($turnArray, [$NextNo => "turn"]);
      break;
    }
  }
}

function isContenu($turnArray) {
  global $playerNumber;
  $count = array_count_values($turnArray);
  $passCount = $count["pass"] ?? 0;
  $finishedCount = $count["finished"] ?? 0;
  if ($passCount == $playerNumber-$finishedCount-1) {
    return false;
  } else {
    return true;
  }
}
function countFinishedPlayers($playersCards){
  $result = 0;
  for ($i = 0; $i < count($playersCards); $i++) {
    if(count($playersCards[$i]) == 0 ){
      $result++ ;
    }
  }
  return $result;
}
?>