<?php

function all_games($db){
  $sql = $db->prepare("SELECT *
                       FROM videojuego
                       WHERE videojuego.suscription = 'False';");

  $result = $sql->execute();
  $result = $sql->fetchAll();

  return $result;
};

function particular_game($db, $id_game){
  $sql = $db -> prepare(
  "SELECT Provedor.*, Producto.id_game, Producto.price
  from Provedor, Producto
  WHERE (Provedor.id = Producto.id_suplair) AND Producto.id_game = $id_game");

  $result = $sql->execute();
  $result = $sql->fetchAll();

  $sql2 = $db->prepare(
  "SELECT videojuego.title
  FROM videojuego
  WHERE videojuego.id = $id_game");

  $result2 = $sql2->execute();
  $result2 = $sql2->fetchAll();

  return array($result, $result2);
}

function checkifusergame($db, $id_game, $id_user) {
  $sql = $db -> prepare(
    "SELECT *
    from Juegosusuario
    WHERE (Juegosusuario.id_user = $id_user) AND Juegosusuario.id_game = $id_game");
  
    $result = $sql->execute();
    $result = $sql->fetchAll();
    echo $result;
    if ($result == NULL) {
      $anwser = TRUE;
    }
    else {
      $anwser = FALSE;
    }
    return array($anwser);
};

function register_purchase($db, $id_user, $date, $price, $preorder, $id_game, $id_pro) {
  $sql = $db -> prepare(
    "INSERT INTO $db.Pagovideojuego VALUES ($price, $date, $id_user, $preorder, $id_pro, $id_game"
  );
  $result = $sql->execute();
}


?>