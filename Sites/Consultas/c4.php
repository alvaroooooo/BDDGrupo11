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
    $nom_genero = $_POST["genero"];
    $sql = $db -> prepare("WITH subgen1 AS (
    SELECT genero.gid, subgenero.subgenero_id
    FROM genero, subgenero 
    WHERE genero.nombre = '$nom_genero'
    AND genero.gid = subgenero.gid),
    subgen AS (
    SELECT DISTINCT(gid) FROM subgen1
    UNION
    SELECT subgenero_id FROM subgen1
    UNION
    SELECT genero.gid FROM genero WHERE genero.nombre = '$nom_genero'
    )

    SELECT DISTINCT(peliculas.titulo) 
    FROM peliculas, tienegeneropeli, subgen
    WHERE peliculas.pid = tienegeneropeli.p_pid
    AND subgen.gid = tienegeneropeli.gid;
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
                <?php echo "<th class='w-1/5'> Peliculas con subgenero '$nom_genero' </th>" ?>
              </tr>
            </thead>
            <tbody>
            <?php //
              foreach($result as $key => $value){
                echo "<tr>";
                echo "<td>".$value[0]."</td>";
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