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
    $username_serie = $_POST["username_serie"];
    $sql = $db -> prepare("SELECT usuario.username, SUM(precio) 
    FROM usuario, contratapelicula,
    (SELECT DISTINCT id_prov, pid, precio FROM ofrecepagadas) as pelis
    WHERE pelis.pid = contratapelicula.p_pid
    AND usuario.uid = contratapelicula.u_uid
    GROUP BY (usuario.username);
                        ");
    $result = $sql -> execute();
    $result = $sql-> fetchAll();
    //print_r($result); //Quitar
    ?>
  
    <br>
      <div class="row justify-content-center">
        <div class="col-6">
          <table class="table-fixed">
            <thead>
              <tr class="head">
                <th class='w-1/5'> Nombre </th>
                <th class='w-1/5'> Suma gastada </th>
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