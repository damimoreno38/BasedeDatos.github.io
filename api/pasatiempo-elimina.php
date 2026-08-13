<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeEnteroObligatorio.php";
require_once __DIR__ . "/../libservidorphp/devuelveNoContent.php";
require_once __DIR__ . "/Bd.php";

$id = recibeEnteroObligatorio("id");

$bd = Bd::conexion();
$stmt = $bd->prepare("DELETE FROM PASATIEMPO WHERE PAS_ID = :PAS_ID");
$stmt->execute([":PAS_ID" => $id]);

devuelveNoContent();
