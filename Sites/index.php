<?php
require_once('./__init2__.php');
include('./layout/header2.php');
require('./config/config.php');
?>

<body>
  <div style="margin-top: 200px"></div>

  <div class="container">
    <a href="./pages/subscripciones.php" class="btn btn-success"> 
      Ir a subscripciones 
    </a>
    <span></span>
    <a href="./pages/onetime_purchases.php" class="btn btn-info">
      Ir a Onetime Purchases
    </a>
  </div>

  <div style="margin:600px 0px;">
    <span></span>
  </div>

  <?php
  include('./layout/footer.html');
  ?>
</body>