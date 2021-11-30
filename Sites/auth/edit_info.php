<?php
include_once('./../__init__.php');
if (isset($_SESSION['username'])) {
?>

  <body>
    <?php
    include("./../layout/header2.php"); //require
    ?>

    <div style="margin-top: 150px; margin-bottom: 150px;">
      <div class="container mt-5 card w-50 px-5 py-2 border-primary">
        <form class="align-items-center">
          <div class="mt-4 mb-4 text-center">
            <p class="text-primary h2"> Editar contraseña </p>
          </div>

          <div class="mb-3 mt-3 w-100">
            <label for="exampleInputPassword1" class="form-label" aria-autocomplete="off">Contraseña actual</label>
            <input name="old_pass" type="password" class="form-control" id="exampleInputPassword1">
          </div>

          <div class="mb-3 mt-3 w-100">
            <label for="exampleInputPassword1" class="form-label" aria-autocomplete="off"> Nueva contraseña</label>
            <input name="new_pass" type="password" class="form-control" id="exampleInputPassword1">
          </div>

          <div class="mb-3 mt-3 w-100">
            <label for="exampleInputPassword1" class="form-label" aria-autocomplete="off"> Confirmar nueva contraseña</label>
            <input name="confirm_pass" type="password" class="form-control" id="exampleInputPassword1">
          </div>

          <div class="text-center mt-5 mb-3">
            <button type="submit" class="btn btn-primary w-50"> Cambiar contraseña </button>
          </div>

        </form>
      </div>
    </div>

    <?php
    include("./../layout/footer.html")
    ?>
  </body>
<?php
} else {
  include("./error_msg.php");
  include("./../layout/header2.php");
  errorMsg("No se pudo acceder a este sitio porque no estás logeado");
}
?>