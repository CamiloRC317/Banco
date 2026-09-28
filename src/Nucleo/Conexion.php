<?php
namespace App\Nucleo;
use PDO;
class Conexion{
    private static ?PDO $conexion=null;
    private function __construct(){} 
    public static function obtenerConexion(): PDO
    {
        if (self::$conexion === null) {
            self::$conexion = new PDO(
                "mysql:host=localhost;dbname=db_banco_adso;charset=utf8mb4",
                "root",
                "1234"
            );
        }
        return self::$conexion;
    }
}
?>