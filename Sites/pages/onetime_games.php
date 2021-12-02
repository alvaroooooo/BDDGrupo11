<?php
include_once('./../__init__.php');
include('./../layout/header2.php');
include('./../Consultas/cOneTimeGames.php');

$all_games = all_games($db2);

?>

<div class="container" style="margin-top: 70px; margin-bottom: 20px;">
  <h1 class="text-primary mt-2 mb-4"> Juegos </h1>
  <div class="row">
    <div class="col-6">
      <table class="table-fixed">
        <thead>
          <tr class="head">
            <th class="w-1/5"> Titulo </th>
            <th class="w-1/5"> Puntaje </th>
            <th class="w-1/5"> Clasificacion </th>
            <th class="w-1/5"> Fecha de lanzamiento </th>
            <th class="w-1/5"> Beneficio de precompra </th>
            <th class="w-1/5"> Más Info </th>
          </tr>
        </thead>
        <tbody>
          <?php //
          foreach ($all_games as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['title'] . "</td>";
            echo "<td>" . $value['score'] . "</td>";
            echo "<td>" . $value['clasification'] . "</td>";
            echo "<td>" . $value['realise'] . "</td>";
            echo "<td>" . $value['preorder_benefit'] . "</td>";
          ?>
            <td>
              <form method="POST">
                <input type="hidden" name="id" value=<?php echo $value['id'] ?> />
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
        $id_game = $_POST['id'];
        list($info_game, $NombreJuego) = particular_game($db2, $id_game);
      ?>
        <div class="d-flex justify-content-center">
          <div class="card text-dark border-info" style="width: 85%;">
            <h4 class="card-header text-center text-primary">
              Información del juego <?php echo $NombreJuego[0][0] ?>
            </h4>
            <div class="d-flex justify-content-center">
              <table class="table-primary w-75 mb-3 mt-4">
                <thead>
                  <tr class="head">
                    <th class="w-1/3"> Nombre Provedor </th>
                    <th class="w-1/3"> Plataforma </th>
                    <th class="w-1/3"> Precio </th>
                    <th class="w-1/3"> Comprar </th>
                  </tr>
                </thead>
                <tbody>
                  <?php //
                  foreach ($info_game as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['name'] . "</td>";
                    echo "<td>" . $value['platform'] . "</td>";
                    echo "<td>" . $value['price'] . "</td>";
                  ?>
                    <td>
                      <form method="POST">
                        <input type="hidden" name="tipo" value=<?php echo 1 ?>>
                        <input type="hidden" name="provedor" value=<?php echo $value['name'] ?> />
                        <input type="hidden" name="id_game" value=<?php echo $id_game ?> />
                        <input type="hidden" name="type" value=<?php echo "Juego" ?> />
                        <button type="submit" class="btn btn-outline-success"> Comprar </button>
                      </form>
                    </td>
                  <?php echo "</tr>"; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php }
      ?>
    </div>
  </div>
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
      $proc = new StoreProc($db);
      $result = $proc->purchase();
    }
  }
}
?>




<?php
include('./../layout/footer.html')
?>