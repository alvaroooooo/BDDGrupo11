<?php
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data.php'); 
    # Se crea la instancia de PDO
    $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }

  //$con = mysqli_connect($host, $usuario, $password, $bdd);
  function consolelog($chunk){
    echo "<script> console.log($chunk) </script>";
  };
  try {
    $max_temp_series_query = $db -> prepare("SELECT MAX(temporadas) FROM series;");
    $max_temp_series_query -> execute();
    $max_temp_series = $max_temp_series_query -> fetchAll();
    $max_temp_series = $max_temp_series[0][0] + 1;
    $nombre_generos = "SELECT genero.nombre FROM genero;";
    $nombre_generos_query = $db -> prepare($nombre_generos);
    $nombre_generos_query -> execute();
    $nombre_generos_query = $nombre_generos_query -> fetchAll();
  } catch (Exception $e) {
    echo "No se pudo hacer la consulta";
  };
?>

