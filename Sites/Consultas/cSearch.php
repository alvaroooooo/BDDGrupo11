<?php

function searchByProvAndName($db, $proveedor, $peliculaOSerie) {

  $sqlSerie = $db->prepare(
  "WITH filtrar_serie AS ( 
  SELECT ofreceserie.id_prov, ofreceserie.sid, series.titulo 
  FROM ofreceserie, series
  WHERE ofreceserie.sid = series.sid
  AND LOWER(series.titulo) LIKE LOWER('%{$peliculaOSerie}%')
  ), 
  filter_proveedor AS (
  SELECT filtrar_serie.id_prov, filtrar_serie.sid, filtrar_serie.titulo AS tituloserie, proveedor.nombre AS nombreprov 
  FROM filtrar_serie, proveedor
  WHERE filtrar_serie.id_prov = proveedor.pro_id
  AND LOWER(proveedor.nombre) LIKE LOWER('%{$proveedor}%')
  )

  SELECT * 
  FROM filter_proveedor;
  ");

  $resultSerie = $sqlSerie->execute();
  $resultSerie = $sqlSerie->fetchAll();

  $sqlPeli = $db->prepare(
  "WITH filtrar_peli AS ( 
  SELECT ofreceenplan.id_prov, ofreceenplan.pid, peliculas.titulo 
  FROM ofreceenplan, peliculas
  WHERE ofreceenplan.pid = peliculas.pid
  AND LOWER(peliculas.titulo) LIKE LOWER('%{$peliculaOSerie}%')
  ), 
  filter_proveedor AS (
  SELECT filtrar_peli.id_prov, filtrar_peli.pid, filtrar_peli.titulo AS titulopeli, proveedor.nombre AS nombreprov 
  FROM filtrar_peli, proveedor
  WHERE filtrar_peli.id_prov = proveedor.pro_id
  AND LOWER(proveedor.nombre) LIKE LOWER('%{$proveedor}%')
  )

  SELECT * 
  FROM filter_proveedor;
  "
  );

  $resultPeli = $sqlPeli->execute();
  $resultPeli = $sqlPeli->fetchAll();
  return array($resultSerie, $resultPeli);
}

?>