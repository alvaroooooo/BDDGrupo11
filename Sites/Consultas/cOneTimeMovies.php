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
};

function purchase($id_user, $id_movie, $id_pro, $price, $date_pur) {
    $stmt = $this->pdo->prepare('SELECT * FROM purchase(:id_user,:id_movie, :id_pro, :price, :date_pur)');
    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
    $stmt->execute([
        ':id_user' => $id_user,
        ':id_movie' => $id_movie,
        ':id_pro' => $id_pro,
        ':price' => $price,
        ':date_pur' => $date_pur
    ]);
    $id_user_f = $stmt->fetchColumn(0);
    $id_movie_f = $stmt->fetchColumn(1);
    $id_pro_f = $stmt->fetchColumn(2);
    $price_f = $stmt->fetchColumn(3);
    $date_f = $stmt->fetchColumn(4);

};

function name_prov($db, $name) {
    $sql = $db -> prepare(
    "SELECT DISTINCT proveedor.pro_id
    FROM proveedor
    WHERE proveedor.nombre = $name");
    
    $result = $sql->execute();
    $result = $sql->fetchAll();

    foreach ($result as $r) {
        $id_pro = $r;
    }

    return $id_pro;

}

function get_price($db, $id_movie, $id_prov) {
  $sql = $db -> prepare(
    "SELECT ofrecepagadas.costo
    FROM peliculas, ofrecepagadas
    WHERE peliculas.pid = ofrecepagadas.pid
    AND peliculas.pid = $id_movie
    AND ofrecepagadas.id_prov = $id_prov");
    
    $result = $sql->execute();
    $result = $sql->fetchAll();

    foreach ($result as $r) {
        $price = $r;
    }

    return $price;

}



?>