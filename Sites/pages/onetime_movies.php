<?php
include_once('./../__init__.php');
include('./../layout/header2.php');
include('./../Consultas/cOneTimeMovies.php');

$all_movies = all_movies($db);

?>


<div class="container" style="margin-top: 75px; margin-bottom: 20px;">
  <h1 class="text-primary mt-1 mb-3"> Películas </h1>

  <div class="row">
    <div class="col-6">
      <table class="table-fixed">
        <thead>
          <tr class="head">
            <th class="w-1/5"> Titulo </th>
            <th class="w-1/5"> Puntaje </th>
            <th class="w-1/5"> Clasificacion </th>
            <th class="w-1/5"> Fecha de lanzamiento </th>
            <th class="w-1/5"> Duración </th>
            <th class="w-1/5"> Más Info </th>
          </tr>
        </thead>
        <tbody>
          <?php //
          foreach ($all_movies as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['titulo'] . "</td>";
            echo "<td>" . $value['puntuacion'] . "</td>";
            echo "<td>" . $value['clasificacion'] . "</td>";
            echo "<td>" . $value['ano'] . "</td>";
            echo "<td>" . $value['duracion'] . "</td>";
          ?>
            <td>
              <form method="POST">
                <input type="hidden" name="pid" value=<?php echo $value['pid'] ?> />
                <input type="hidden" name="tipo" value=<?php echo 0 ?> />
                <button type="submit" class="btn btn-outline-success"> +Info </button>
              </form>
            </td>
          <?php
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="col-6">
      <?php
      $request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
      if (($request_method === 'POST') and ($_POST['tipo'] == 0)) {
        $id_movie = $_POST['pid'];
        list($info_movie, $NameMovie) = info_movie($db, $id_movie);
      ?>
        <div class="d-flex justify-content-center">
          <div class="card text-dark border-info" style="width: 85%;">
            <h4 class="card-header text-center text-primary">
              Información de película de <?php echo $NameMovie[0][0] ?>
            </h4>
            <div class="d-flex justify-content-center">
              <table class="table-primary w-75 mb-3 mt-4">
                <thead>
                  <tr class="head">
                    <th class="w-1/3"> Nombre Provedor </th>
                    <th class="w-1/3"> Precio </th>
                    <th class="w-1/3"> Comprar </th>
                  </tr>
                </thead>
                <tbody>
                  <?php //
                  foreach ($info_movie as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['nombre'] . "</td>";
                    echo "<td>" . $value['costo'] . "</td>";
                  ?>
                    <td>
                      <form method="POST">
                        <input type="hidden" name="tipo" value=<?php echo 2 ?>>
                        <input type="hidden" name="provedor" value=<?php echo $value['nombre'] ?> />
                        <input type="hidden" name="id_movie" value=<?php echo $id_movie ?> />
                        <input type="hidden" name="type" value=<?php echo "Pelicula" ?> />
                        <button type="submit" class="btn btn-outline-success"> Comprar </button>
                      </form>
                    </td>
                  <?php echo "</tr>";
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php }
        ?>
        </div>

        <?php
        if (($request_method === 'POST') and ($_POST['tipo'] == 1)) {
          echo "Comprar Juego";
          if (isset($_SESSION['username'])) {
            $result = checkifusergame($db, $_POST["id_game"], $_SESSION['uid']);
            echo $result;
            if ($result == TRUE) {
              # Ejecutar funcion
            }
          }
        }
        if (($request_method === 'POST') and ($_POST['tipo'] == 2)) {
          echo "Comprar Pelicula";
          if (isset($_SESSION['username'])) {
            $result = checkifusergame($db2, $_POST["id_movie"], $_SESSION['uid']);
            echo $result;
            if ($result == TRUE) {
              # Ejecutar funcion
            }
          }
        }
        ?>
    </div>
  </div>
</div>


<?php
include('./../layout/footer.html')
?>