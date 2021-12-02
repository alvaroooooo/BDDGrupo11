<?php

function successMsg2($msg)
{
?>
  <div style="margin-top: 100px;"></div>
  <div class="container mt-5">
    <div class="alert alert-success d-flex justify-content-between" role="alert">
      <div class="ms-3 d-flex align-items-center">
        <?php echo $msg ?>
      </div>
      <div class="d-flex justify-content-end me-5">
        <a class="btn btn-success" href="./login.php"> Ir a login </a>
      </div>
    </div>

  </div>

<?php
}
?>