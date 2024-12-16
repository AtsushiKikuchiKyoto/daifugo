<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include 'View/head.php'; ?>
  </head>

  <body>
    <div class="wrapper" >
      <div class="menubar col-12 bg-dark  text-white text-center agu-display">Daifu_GO!</div>
      <div class="upper d-flex">

        <!-- 状態エリア -->
        <div class="left col-4 bg-secondary bg-gradient text-white p-2">
          <?php include 'View/left.php'; ?>
        </div>

        <!-- テーブルエリア -->
        <div class="right col-8 bg-light bg-gradient text-dark p-2">
          <?php include 'View/right.php'; ?>
        </div>
      </div>

      <!-- 手札エリア -->
      <div class="lower col-12  bg-success bg-gradient text-white p-2">
        <?php include 'View/lower.php'; ?>
      </div>
    </div>

    <?php include 'View/script.php'; ?>
  </body>
</html>