<?php

function errorMsg($msg)
{
?>

  <div class="container">
    <div class="alert alert-danger w-100" role="alert">
      Error
      <hr />
      <?php echo $msg; ?>
      
    </div>
  </div>

<?php
}
?>