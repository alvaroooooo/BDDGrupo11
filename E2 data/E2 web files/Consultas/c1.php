<?php
//include("../config/config.php");
include("../layout/header.php"); //require
?>
<body>
  <div class="general">
    <p class="display-6 special"> Resultados para la consulta </p>
    <hr>
    <?php
    // Comentar en php 
    require("../config/config.php"); //require
    $sql = $db -> prepare("SELECT peliculas.titulo AS titulodepeliculaserie, proveedor.nombre
                          FROM peliculas, ofreceenplan, proveedor
                          WHERE peliculas.pid = ofreceenplan.pid
                          AND ofreceenplan.id_prov = proveedor.pro_id
                          ORDER BY proveedor.nombre, peliculas.titulo;
                        ");

    $sql2 = $db -> prepare("SELECT series.titulo, proveedor.nombre
    FROM series, proveedor, ofreceserie
    WHERE ofreceserie.sid =  series.sid
    AND proveedor.pro_id = ofreceserie.id_prov
    ORDER BY proveedor.nombre, series.titulo;");

    $result = $sql -> execute();
    $result = $sql-> fetchAll(); // Para las peliculas 
    $result2 = $sql2 -> execute();
    $result2 = $sql2-> fetchAll(); // Para las series
    ?>

    <br>
      <div class="row justify-content-center">
        <div class="col-6">
          <table class="table-fixed">
            <thead>
              <tr class="head">
                <th class="w-1/5"> Pelicula </th>
                <th class="w-1/5"> Proveedor </th>
              </tr>
            </thead>
            <tbody>
            <?php //
              foreach($result as $key => $value){
                echo "<tr>";
                echo "<td>".$value[0]."</td>";
                echo "<td>".$value[1]."</td>";
                echo "</tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
        <div class="col-6">
          <table class=table-fixed>
            <thead>
              <tr class="head">
                <th class="w-1/5"> Serie </th>
                <th class="w-1/5"> Proveedor </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($result2 as $key => $value){
                echo "<tr>";
                echo "<td>".$value[0]."</td>";
                echo "<td>".$value[1]."</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <br>
  </div>
  <div style="margin-bottom: 100px"> 
  </div>
</body>
<?php
include('../layout/footer.html')
?>