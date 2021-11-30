<?php
include_once('./../__init__.php');

include('./../layout/header2.php');
include('./../Consultas/cSearch.php');

?>

<div style="margin-top: 100px;"> </div>

<?php

$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
if ($request_method === 'POST') {

  $pelicula = trim($_POST['pelicula']);
  $proveedor = trim($_POST['proveedor']);

  list($series, $pelis) = searchByProvAndName($db, $proveedor, $pelicula);
};

?>

<div class="container">
  <div class="mt-2 mb-3">
    <h3 class="text-danger">
      Resultados para
      título: '<?php echo $pelicula ?>'
      y proveedor: '<?php echo $proveedor ?>'
    </h3>
  </div>
  <div class="row">
    <div class="col-6">
      <h4 class="text-primary text-center mt-1 mb-3"> Peliculas </h4>
      <table class="table-fixed">
        <thead>
          <tr class="head">
            <th class="w-1/5"> Pelicula </th>
            <th class="w-1/5"> Proveedor </th>
          </tr>
        </thead>
        <tbody>
          <?php //
          foreach ($pelis as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['titulopeli'] . "</td>";
            echo "<td>" . $value['nombreprov'] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="col-6">
      <h4 class="text-primary text-center mt-1 mb-3"> Series </h4>
      <table class="table-fixed">
        <thead>
          <tr class="head">
            <th class="w-1/5"> Series </th>
            <th class="w-1/5"> Proveedor </th>
          </tr>
        </thead>
        <tbody>
          <?php //
          foreach ($series as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['tituloserie'] . "</td>";
            echo "<td>" . $value['nombreprov'] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
include('./../layout/footer.html');
?>