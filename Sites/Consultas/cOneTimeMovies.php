<?php

function all_movies($db){
  $sql = $db->prepare("SELECT DISTINCT peliculas.titulo, peliculas.puntuacion, peliculas.clasificacion, peliculas.duracion, peliculas.ano, peliculas.pid
                FROM ofrecepagadas, peliculas
                WHERE ofrecepagadas.pid = peliculas.pid;");

  $result = $sql->execute();
  $result = $sql->fetchAll();

  return $result;
};

function info_movie($db, $id_movie){
    $sql = $db -> prepare(
        "SELECT proveedor.*, ofrecepagadas.costo
        FROM ofrecepagadas, peliculas, proveedor
        WHERE ofrecepagadas.pid = peliculas.pid
        AND ofrecepagadas.id_prov = proveedor.pro_id
        AND peliculas.pid = $id_movie");
  
    $result = $sql->execute();
    $result = $sql->fetchAll();
  
    $sql2 = $db->prepare(
    "SELECT peliculas.titulo
    FROM peliculas
    WHERE peliculas.pid = $id_movie");
  
    $result2 = $sql2->execute();
    $result2 = $sql2->fetchAll();
  
    return array($result, $result2);
  }

function checkifusermovie($db, $id_movie, $id_user) {
  $sql = $db -> prepare(
    "SELECT *
    FROM contratapelicula
    WHERE (contratapelicula.u_uid = $id_user) AND contratapelicula.p_pid = $id_movie");
  
    $result = $sql->execute();
    $result = $sql->fetchAll();
  
    if ($result == NULL) {
      $anwser = TRUE;
    }
    else {
      $anwser = FALSE;
    }
    return array($anwser);
}

?>