<?php

function proveedores_general($db){
  $sql = $db->prepare("WITH cantidadpeliculas AS (
                      SELECT id_prov, count(pid) as cantidadpeliculas
                      FROM ofreceenplan 
                      GROUP BY id_prov),
                      cantidadseries AS (
                      SELECT id_prov, count(sid) as cantidadseries 
                      FROM ofreceserie GROUP BY id_prov)

                      SELECT *
                      FROM proveedor, cantidadpeliculas, cantidadseries
                      WHERE proveedor.pro_id = cantidadpeliculas.id_prov 
                      AND proveedor.pro_id = cantidadseries.id_prov;
                    ");

  $result = $sql->execute();
  $result = $sql->fetchAll();

  return $result;
};

function proveedor_particular($db, $id_prov){
  $sql = $db -> prepare(
  "WITH filter AS (
  SELECT ofreceenplan.id_prov, vepeli.p_pid,count(u_uid) as cantidadvisto
  FROM ofreceenplan, vepeli
  WHERE ofreceenplan.pid = vepeli.p_pid
  GROUP BY ofreceenplan.id_prov, vepeli.p_pid
  ORDER BY ofreceenplan.id_prov ASC),
  filter_2 AS (
  SELECT *
  FROM filter, peliculas
  WHERE filter.p_pid = peliculas.pid)

  SELECT proveedor.nombre, filter_2.titulo, filter_2.cantidadvisto, filter_2.puntuacion
  FROM filter_2, proveedor
  WHERE filter_2.id_prov = proveedor.pro_id
  AND proveedor.pro_id = {$id_prov}
  ORDER BY filter_2.cantidadvisto DESC limit 3;
  "
  );

  $result = $sql->execute();
  $result = $sql->fetchAll();

  $sql2 = $db->prepare(
  "WITH capituloserie AS (
  SELECT * FROM veserie, capitulo 
  WHERE veserie.c_cid = capitulo.cid),
  filter AS (
  SELECT ofreceserie.id_prov, capituloserie.s_sid,count(u_uid) as cantidadvisto
  FROM ofreceserie, capituloserie
  WHERE ofreceserie.sid = capituloserie.s_sid
  GROUP BY ofreceserie.id_prov, capituloserie.s_sid
  ORDER BY ofreceserie.id_prov ASC),
  filter_2 AS (
  SELECT *
  FROM filter, series
  WHERE filter.s_sid = series.sid)

  SELECT proveedor.nombre, filter_2.titulo, filter_2.cantidadvisto, filter_2.puntuacion
  FROM filter_2, proveedor
  WHERE filter_2.id_prov = proveedor.pro_id
  AND proveedor.pro_id = {$id_prov}
  ORDER BY filter_2.cantidadvisto DESC limit 3;
  "
  );

  $result2 = $sql2->execute();
  $result2 = $sql2->fetchAll();

  return array($result, $result2);
}

?>