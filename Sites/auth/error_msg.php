<?php

function errorMsg($msg)
{
?>
  <div style="margin-top: 100px;"> </div>
  <div class="container mt-5">
    <div class="alert alert-danger d-flex justify-content-between" role="alert">
      <div class="ms-3 d-flex align-items-center">
        <?php echo $msg ?>
      </div>
      <div class="d-flex justify-content-end me-5">
        <a class="btn btn-danger" onclick="history.go(-1);"> Volver </a>
      </div>
    </div>

  </div>

<?php
}
?>