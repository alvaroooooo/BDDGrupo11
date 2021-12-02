<body>
  <?php
  include("./../layout/header2.php"); //require
  ?>

  <div style="margin-top: 80px;"></div>
  <div class="container mt-5 card w-50 px-5 py-2 border-primary">
    <form class="align-items-center" method="POST" action="./validateRegist.php">
      <div class="mt-4 mb-4 text-center">
        <p class="text-primary h2"> Registrarse </p>
      </div>

      <div class="mb-3 mt-3 w-100">
        <label for="exampleInputEmail1" class="form-label">Tú nombre</label>
        <input name="nombre" type="text" class="form-control" placeholder="Ejemplo: Juan" autocomplete="off">
        <div id="emailHelp" class="form-text"> No se compartira la información </div>
      </div>

      <div class="mb-3 mt-3 w-100">
        <label for="exampleInputEmail1" class="form-label">Nombre usuario</label>
        <input name="username" type="text" class="form-control" placeholder="Ejemplo: Juanito10" autocomplete="off">
        <div id="emailHelp" class="form-text"> No se compartira la información </div>
      </div>

      <div class="mb-3 mt-3 w-100">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" placeholder="Ejemplo: Juanito@gmail.com" autocomplete="off">
        <div id="emailHelp" class="form-text"> No se compartira la información </div>
      </div>

      <div class="mb-3 mt-3 w-100">
        <label for="exampleInputPassword1" class="form-label" aria-autocomplete="off">Contraseña</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        <div id="emailHelp" class="form-text"> El largo debe ser mayor que 4 caracteres </div>
      </div>

      <div class="mb-3 mt-3 w-100">
        <label for="exampleInputPassword1" class="form-label" aria-autocomplete="off">Confirmar contraseña</label>
        <input name="confirm_password" type="password" class="form-control" id="exampleInputPassword1">
      </div>

      <div class="text-center mt-5 mb-3">
        <button type="submit" class="btn btn-primary w-50">Crear nueva cuenta</button>
      </div>

    </form>

    <a href="./login.php" class="btn btn-link text-center">
      Ingresar con cuenta existente
    </a>
  </div>


  <?php
  include("./../layout/footer.html")
  ?>

</body>