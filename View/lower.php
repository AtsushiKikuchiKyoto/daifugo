<?php
include "helper/card-funcs.php";

$cards = [["H",4],["C",3],["H",2],["D",12],["S",1]];

?>

<div class="mycards">
  <p>手札</p>
  <div class="d-flex">

  <?php if (isValidCards($cards)) : ?>
  <?php foreach ($cards as $index => $card) : ?>
    <div class="card-custom card col-1 bg-white p-2 shadow-lg">
      <img src="helper/image/<?= $card[0] ?>.png" alt="<?= getSuitName($card) ?>" class="suit">
      <div class="number text-right text-dark"><?= $card[1] ?></div>
      <div class="number text-right text-dark">index:<?= $index ?></div>
    </div>
  <?php endforeach; ?>
  <?php else : ?>
    <p>無効なカード情報が含まれています。</p>
  <?php endif; ?>
  </div>
</div>