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
    $username= $_POST["username"];
    $sql = $db -> prepare("SELECT DISTINCT(peliculas.titulo)
    FROM peliculas, subscripcion, proveedor, ofreceenplan, usuario, subproveedor, subusuario
    WHERE peliculas.pid = ofreceenplan.pid
    AND proveedor.pro_id = subproveedor.pro_id
    AND subscripcion.subs_id = subproveedor.subs_id
    AND usuario.uid = subusuario.uid
    AND subscripcion.subs_id = subusuario.subs_id
    AND usuario.username = '$username'
    AND subscripcion.estado = 'activa'
    UNION
    SELECT peliculas.titulo
    FROM peliculas, contratapelicula, usuario
    WHERE usuario.uid = contratapelicula.u_uid
    AND peliculas.pid = contratapelicula.p_pid
    AND usuario.username = '$username';
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
                <?php echo "<th class='w-1/5'> Peliculas que puede ver $username </th>" ?>
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