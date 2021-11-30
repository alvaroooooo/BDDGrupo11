<?php
include_once('./../__init__.php');
include('./../layout/header2.php');
include('./../Consultas/cInfoProveedores.php');

$prov_info = proveedores_general($db);

?>

<body>
  <div style="margin-top: 100px;"> </div>
  <div class="container mt-4">
    <div class="row">
      <div class="col-6">
        <div class="card border-primary mb-4">
          <p class="card-header text-center h4 text-primary"> 
            Buscador de proveedores y peliculas/serie
          </p>
          <div class="card-body">
            <form method="POST" action="./search_result.php" >
              <div class="row">
                <div class="col-6">
                  <label class="form-label"> Pelicula o Serie </label>
                  <input class="form-control" name="pelicula" placeholder="Ej: scream" >
                </div>
                <div class="col-6">
                  <label class="form-label"> Proveedor </label>
                  <input class="form-control" name="proveedor" placeholder="Ej: amazon" >
                </div>
              </div>
              <div class="d-flex mt-4 mb-1 justify-content-center">
                <button type="submit" class="btn btn-primary w-75"> Buscar </button>
              </div>
            </form>
          </div>
        </div>

        <table class="table-fixed">
          <thead>
            <tr class="head">
              <th class="w-1/5"> Proveedor </th>
              <th class="w-1/5"> Tarifa </th>
              <th class="w-1/5"> Nro Pelis </th>
              <th class="w-1/5"> Nro Series </th>
              <th class="w-1/5"> Más Info </th>
            </tr>
          </thead>
          <tbody>
            <?php //
            foreach ($prov_info as $key => $value) {
              echo "<tr>";
              echo "<td>" . $value['nombre'] . "</td>";
              echo "<td>" . $value['costo'] . "</td>";
              echo "<td>" . $value['cantidadpeliculas'] . "</td>";
              echo "<td>" . $value['cantidadseries'] . "</td>";
            ?>
              <td>
                <form method="POST">
                  <input type="hidden" name="id_prov" value=<?php echo $value['pro_id'] ?> />
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
        if ($request_method === 'POST') {
          $id_proveedor = $_POST['id_prov'];
          list($infoPeli, $infoSerie) = proveedor_particular($db, $id_proveedor);
        ?>
          <div class="d-flex justify-content-center">
            <div class="card text-dark border-info" style="width: 85%;">
              <h4 class="card-header text-center text-primary">
                Info de <?php echo $infoPeli[0][0] ?>
              </h4>
              <div class="d-flex justify-content-center">
                <table class="table-primary w-75 mb-3 mt-4">
                  <thead>
                    <tr class="head">
                      <th class="w-1/3"> Pelicula </th>
                      <th class="w-1/3"> Vistos </th>
                      <th class="w-1/3"> Puntuación </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php //
                    foreach ($infoPeli as $key => $value) {
                      echo "<tr>";
                      echo "<td>" . $value['titulo'] . "</td>";
                      echo "<td>" . $value['cantidadvisto'] . "</td>";
                      echo "<td>" . $value['puntuacion'] . "</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <div class="d-flex justify-content-center">
                <table class="table-primary w-75 mt-3 mb-4">
                  <thead>
                    <tr class="head">
                      <th class="w-1/3"> Serie </th>
                      <th class="w-1/3"> Vistos </th>
                      <th class="w-1/3"> Puntuación </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php //
                    foreach ($infoSerie as $key => $value) {
                      echo "<tr>";
                      echo "<td>" . $value['titulo'] . "</td>";
                      echo "<td>" . $value['cantidadvisto'] . "</td>";
                      echo "<td>" . $value['puntuacion'] . "</td>";
                      echo "</tr>";
                    }
                    ?>
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
  include('./../layout/footer.html');
  ?>
</body>