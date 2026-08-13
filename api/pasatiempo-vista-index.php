<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/devuelveJson.php";
require_once __DIR__ . "/Bd.php";

$bd = Bd::conexion();
$stmt = $bd->query(
 "SELECT PAS_ID, PAS_NOMBRE FROM PASATIEMPO ORDER BY PAS_NOMBRE"
);
$lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

$render = "";
foreach ($lista as $modelo) {
 $id = $modelo["PAS_ID"];
 $query = htmlentities(http_build_query(["id" => $id]));
 $urlModifica = "modifica.html?$query";
 $nombre = htmlentities($modelo["PAS_NOMBRE"]);
 $render .=
  "<li>
    <p>
     <a href='$urlModifica'>$nombre</a>
    </p>
   </li>";
}

devuelveJson(["lista" => ["innerHTML" => $render]]);
