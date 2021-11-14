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
    $n = $_POST["n"];
    $sql = $db -> prepare("SELECT titulo
                          FROM series
                          WHERE temporadas >= $n;
                        ");

    $result = $sql -> execute();
    $result = $sql-> fetchAll(); // Para las peliculas 
    ?>

    <br>
      <div class="row justify-content-center">
        <div class="col-6">
          <table class="table-fixed">
            <thead>
              <tr class="head">
                <th class="w-1/5"> Series </th>
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