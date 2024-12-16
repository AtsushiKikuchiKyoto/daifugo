<?php
include "helper/card-funcs.php";

$playerNumber = 3;
$cards = allCards();
echo showCards($cards);

$cards = shuffleCards($cards);

for ($i = 0; $i < $playerNumber; $i++) {

}

echo showCards($cards);
?>