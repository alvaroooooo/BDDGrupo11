<?php
include './../__init__.php';
if (isset($_SESSION['nombre'])) {
  include('./../layout/header2.php');
  include('./../Consultas/cProveedores.php')
?>

  <br />
  <?php
  // Acá poner las funciones de php
  $activeSubs = userSubscriptions($db, $_SESSION['uid']);
  $tiempoPeli = timeSpendPeli($db, $_SESSION['uid']);
  $tiempoSerie = timeSpendSerie($db, $_SESSION['uid']);
  $tiempoVideoJuego = 0;
  $totalTime = $tiempoPeli + $tiempoSerie + $tiempoVideoJuego;
  ?>
  <br />

  <div class="container mt-5 d-flex justify-content-center" style="margin-top: 50px !important;">
    <div class="row">
      <div class="col-6">
        <div class="card border-success mb-3 mt-3" style="max-width: 40rem; width: 30rem; min-width: 25rem">
          <div class="card-header text-success text-center">
            <span class="text-success h3">
              Info Personal
            </span>
          </div>
          <div class="card-body text-secondary ps-3 pe-3">
            <div class="row mt-2 mb-4">
              <div class="col-4 text-end pe-2">
                <p class="card-title h5" style="margin: 30px 0px !important"> Nombre: </p>
                <p class="card-text h5" style="margin: 30px 0px !important"> Email: </p>
                <p class="card-text h5" style="margin: 30px 0px !important"> Username: </p>
              </div>
              <div class="col-8">
                <h5 class="card-title h5" style="margin: 30px 0px !important"> <?php echo $_SESSION['nombre'] ?> </h5>
                <p class="card-text h5" style="margin: 30px 0px !important"> <?php echo $_SESSION['email'] ?> </p>
                <p class="card-text h5" style="margin: 30px 0px !important"> <?php echo $_SESSION['username'] ?> </p>
              </div>
            </div>

            <div class="d-flex justify-content-center mt-3 mb-4">
              <a href="./edit_info.php" class="btn btn-outline-primary w-50">
                Cambiar Contraseña
              </a>
            </div>
          </div>
        </div>

        <div class="card border-success mb-3" style="max-width: 40rem; width: 30rem; min-width: 25rem">
          <div class="card-header text-success text-center">
            <span class="text-success h3">
              Tiempo dedicado
            </span>
          </div>
          <div class="card-body text-secondary ps-3 pe-3">
            <div class="row mt-2 mb-4">
              <div class="col-7 text-end pe-2">
                <p class="card-title h6" style="margin: 30px 0px !important"> Tiempo total Películas: </p>
                <p class="card-text h6" style="margin: 30px 0px !important"> Tiempo total Series: </p>
                <p class="card-text h6" style="margin: 30px 0px !important"> Tiempo total Videojuegos: </p>
                <p class="card-text h6" style="margin: 30px 0px !important">
                  Tiempo total usado:
                </p>
              </div>
              <div class="col-5">
                <p class="card-title h6" style="margin: 30px 0px !important"> <?php echo $tiempoPeli ?> </p>
                <p class="card-text h6" style="margin: 30px 0px !important"> <?php echo $tiempoSerie ?> </p>
                <p class="card-text h6" style="margin: 30px 0px !important"> <?php echo "info" ?> </p>
                <p class="card-text h6" style="margin: 30px 0px !important"> <?php echo $totalTime ?> </p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-6">
        <!-- Colocar info de los streamings activos y otros -->
        <div class="card border-success mb-4 mt-3" style="max-width: 40rem; width: 30rem; min-width: 25rem">
          <div class="card-header text-success text-center">
            <span class="text-success h3">
              Tus Streaming y Juegos
            </span>
          </div>
          <div class="card-body text-secondary ps-3 pe-3 d-flex justify-content-center">
            <table class="table table-striped w-75">
              <thead>
                <tr class="head">
                  <!-- <th class="w-1/5"> Pelicula </th> -->
                  <th class="w-1/5"> Tus Streamings </th>
                  <th class="w-1/5"> Inicio </th>
                </tr>
              </thead>
              <tbody>
                <?php //
                foreach ($activeSubs as $key => $value) {
                  echo "<tr>";
                  echo "<td>" . $value[0] . "</td>";
                  echo "<td>" . $value[1] . "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="margin-top: 20px;"></div>

<?php
  require_once('./../layout/footer.html');
} else {
}
?>