<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeTextoObligatorio.php";
require_once __DIR__ . "/../libservidorphp/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";

$nombre   = recibeTextoObligatorio("nombre");
$apellido = recibeTextoObligatorio("apellido");
$celular  = recibeTextoObligatorio("celular");

$bd = Bd::conexion();

$stmt = $bd->prepare(
 "INSERT INTO PASATIEMPO (
    PAS_NOMBRE,
    PAS_APELLIDO,
    PAS_CELULAR
   ) values (
    TRIM(:PAS_NOMBRE),
    TRIM(:PAS_APELLIDO),
    TRIM(:PAS_CELULAR)
   )"
);

$stmt->execute([
 ":PAS_NOMBRE"   => $nombre,
 ":PAS_APELLIDO" => $apellido,
 ":PAS_CELULAR"  => $celular
]);

$id = $bd->lastInsertId();

$query = http_build_query(["id" => $id]);

devuelveCreated(
 "/api/pasatiempo-vista-modifica.php?$query",
 [
  "id"       => ["value" => $id],
  "nombre"   => ["value" => $nombre],
  "apellido" => ["value" => $apellido],
  "celular"  => ["value" => $celular],
 ]
);