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
    $nom_peli = $_POST["nombre_peli_serie"];
    $sql = $db -> prepare("SELECT proveedor.nombre AS plataforma, peliculas.titulo 
    AS PeliculaoSerie
    FROM peliculas, ofreceenplan, proveedor
    WHERE peliculas.pid = ofreceenplan.pid
    AND proveedor.pro_id = ofreceenplan.id_prov
    AND LOWER(peliculas.titulo) LIKE LOWER('%$nom_peli%')
    UNION
    SELECT proveedor.nombre, peliculas.titulo
    FROM peliculas, ofrecepagadas, proveedor
    WHERE peliculas.pid = ofrecepagadas.pid
    AND proveedor.pro_id = ofrecepagadas.id_prov
    AND LOWER(peliculas.titulo) LIKE LOWER('%$nom_peli%')
    UNION
    SELECT  proveedor.nombre, series.titulo
    FROM proveedor, series, ofreceserie
    WHERE proveedor.pro_id = ofreceserie.id_prov
    AND series.sid = ofreceserie.sid
    AND LOWER(series.titulo) LIKE LOWER('%$nom_peli%');
                        ");
    $result = $sql -> execute();
    $result = $sql-> fetchAll(); 
    ?>

    <br>
      <div class="row justify-content-center">
        <div class="col-6">
          <table class="table-fixed">
            <thead>
              <tr class="head">
                <th class="w-1/5"> Plataforma </th>
                <th class="w-1/5"> Titulo de Serie o Pelicula </th>
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
      </div>
      <br>
  </div>
  <div style="margin-bottom: 100px"> 
  </div>
</body>
<?php
include('../layout/footer.html')
?>