<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function conexion(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:" . __DIR__ . "/srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   // Se añaden los nuevos campos a la estructura de la tabla
   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS PASATIEMPO (
      PAS_ID INTEGER,
      PAS_NOMBRE TEXT NOT NULL,
      PAS_APELLIDO TEXT NOT NULL,
      PAS_CELULAR TEXT NOT NULL,
      CONSTRAINT PK_PAS PRIMARY KEY(PAS_ID),
      CONSTRAINT UQ_PAS_NOM UNIQUE(PAS_NOMBRE),
      CONSTRAINT CHK_PAS_NOM CHECK(LENGTH(PAS_NOMBRE) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}