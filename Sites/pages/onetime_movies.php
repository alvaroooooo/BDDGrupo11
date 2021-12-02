<?php
include_once('./../__init__.php');
include('./../layout/header2.php');
include('./../Consultas/cOneTimeMovies.php');
include('./buy.sql');

use PostgreSQLTutorial\Connection as Connection;
use PostgreSQLTutorial\StoreProc as StoreProc;

$all_movies = all_movies($db);

?>


<div class="container" style="margin-top: 70px; margin-bottom: 20px;">
  <h1 class="text-primary mt-2 mb-4"> Películas </h1>

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
          if (isset($_SESSION['username'])) {
            $result = checkifusergame($db, $_POST["id_game"], $_SESSION['uid']);
            if ($result == TRUE) {
              $id_user = $_SESSION['uid'];
              $prov_name = $_POST["provedor"];
              list($price, $id_prov) = game_info($db2, $id_game, $prov_name);
              $date = date('y-m-d');
              register_purchase($db2, $id_user, $date, $price, $id_game, $id_prov);
            }
          }
        }
        if (($request_method === 'POST') and ($_POST['tipo'] == 2)) {
          if (isset($_SESSION['username'])) {
            $result = checkifusergame($db2, $_POST["id_movie"], $_SESSION['uid']);
            if ($result == TRUE) {
              $id_user = $_SESSION['uid'];
              $id_movie = $_POST["id_movie"];
              $prov_name = $_POST["provedor"];
              $id_pro = name_prov($db, $prov_name);
              $price = get_price($db, $id_movie, $id_pro);
              $date = date('y-m-d');
              try {
                // connect to the PostgreSQL database
                $pdo = Connection::get()->connect();
                // 
                $storeProc = new StoreProc($pdo);

                $result = $storeProc->purchase($id_user, $id_movie, $id_pro, $price, $date);
                echo $result;
              } catch (\PDOException $e) {
                echo $e->getMessage();
              }
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