<?php

function userSubscriptions($db, $userId){
  $sql = $db -> prepare("WITH sub_user AS (
                        SELECT * from subusuario 
                        WHERE uid = {$userId}), 
                        filter AS (
                        SELECT sub_user.subs_id, subscripcion.estado, subscripcion.fecha_inicio
                        FROM subscripcion, sub_user
                        WHERE sub_user.subs_id = subscripcion.subs_id 
                        AND subscripcion.estado = 'activa'
                        ),
                        filter_2 AS (
                        SELECT filter.subs_id, filter.estado,  subproveedor.pro_id, filter.fecha_inicio
                        FROM filter, subproveedor
                        WHERE filter.subs_id = subproveedor.subs_id
                        )

                        SELECT proveedor.nombre, filter_2.fecha_inicio
                        FROM filter_2, proveedor
                        WHERE filter_2.pro_id = proveedor.pro_id
                        ORDER BY filter_2.fecha_inicio;
                    ");

  $result = $sql -> execute();
  $result = $sql-> fetchAll();

  return $result;
};

function userSubsGames($db2, $userId) {
  $query = $db2 -> prepare(
    "SELECT provedor.name
    FROM comprador, provedor
    WHERE (comprador.id_user = {$userId}) and (provedor.id = comprador.id_suplair)");
  
  $result = $query -> execute();
  $result = $query -> fetchAll();
  
  return $result;
};

function timeSpendPeli($db, $userId){
  $sql2 = $db -> prepare(
    "WITH view_user AS (
    SELECT * 
    FROM vepeli 
    WHERE u_uid = {$userId})

    SELECT view_user.u_uid, SUM(peliculas.duracion) AS totalminutospeli
    FROM view_user, peliculas
    WHERE view_user.p_pid = peliculas.pid
    GROUP BY view_user.u_uid;
  ");
  $result2 = $sql2 -> execute();
  $result2 = $sql2 -> fetchAll();

  return $result2[0][1];
}

function timeSpendSerie($db, $userId){
  $sql = $db->prepare(
    "WITH view_user AS (
    SELECT * 
    FROM veserie 
    WHERE u_uid = {$userId})

    SELECT view_user.u_uid, SUM(capitulo.duracion) AS totalminutoscap
    FROM view_user, capitulo
    WHERE view_user.c_cid = capitulo.cid
    GROUP BY view_user.u_uid;"
  );

  $result = $sql->execute();
  $result = $sql->fetchAll();
  return $result[0][1];
}

function timeSpendGames($db2, $userId){
  $query = "WITH horas as (
        SELECT id_user, sum(Juegosusuario.hours)
        FROM Juegosusuario
        GROUP BY id_user
        )
        SELECT horas.sum AS tiempo FROM horas 
        WHERE horas.id_user = {$userId};";
  $result = $db2->prepare($query);
  $result->execute();
  $dataCollected = $result->fetchAll();
  if (empty($dataCollected[0])){
    return 0;
  } else {
  return $dataCollected[0]['tiempo'];
  };
}

?>