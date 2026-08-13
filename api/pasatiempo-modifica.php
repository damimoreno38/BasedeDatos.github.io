<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeEnteroObligatorio.php";
require_once __DIR__ . "/../libservidorphp/recibeTextoObligatorio.php";
require_once __DIR__ . "/../libservidorphp/devuelveJson.php";
require_once __DIR__ . "/Bd.php";


$id       = recibeEnteroObligatorio("id");
$nombre   = recibeTextoObligatorio("nombre");
$apellido = recibeTextoObligatorio("apellido");
$celular  = recibeTextoObligatorio("celular");

$bd = Bd::conexion();
$stmt = $bd->prepare(
 "UPDATE PASATIEMPO
   SET
    PAS_NOMBRE   = TRIM(:PAS_NOMBRE),
    PAS_APELLIDO = TRIM(:PAS_APELLIDO),
    PAS_CELULAR  = TRIM(:PAS_CELULAR)
   WHERE
    PAS_ID = :PAS_ID"
);

$stmt->execute([
 ":PAS_NOMBRE"   => $nombre,
 ":PAS_APELLIDO" => $apellido,
 ":PAS_CELULAR"  => $celular,
 ":PAS_ID"       => $id,
]);

devuelveJson([
 "id"       => ["value" => $id],
 "nombre"   => ["value" => $nombre],
 "apellido" => ["value" => $apellido],
 "celular"  => ["value" => $celular],
]);