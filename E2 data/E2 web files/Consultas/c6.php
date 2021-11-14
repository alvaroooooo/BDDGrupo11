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
    $sql = $db -> prepare("SELECT series.titulo
    FROM series, capitulo, veserie, usuario
    WHERE series.sid = capitulo.s_sid
    AND usuario.username = '$username_serie'
    AND capitulo.cid = veserie.c_cid
    AND veserie.u_uid = usuario.uid
    AND veserie.fecha >= CURRENT_DATE - INTERVAL '1 year'
    GROUP BY series.titulo
    HAVING count(*) >= 2;
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
                <?php echo "<th class='w-1/5'> Series que $username ha visto más de 1 capítulo </th>" ?>
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