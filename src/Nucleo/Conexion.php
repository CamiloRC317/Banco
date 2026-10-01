<?php
declare(strict_types=1);
namespace App\Nucleo;
use PDO;
class Conexion{
    private static ?PDO $conexion=null;
    private array $config;
    private function __construct(){
        $this->config=require __DIR__."/../../config/config.php";
    } 
    public static function obtenerConexion(): PDO
    {
        $instacia=new self();   
        if (self::$conexion === null) {
            
            $config = sprintf("mysql:host=%s;dbname=%s;charset=%s",
            $instacia->config["host"],
            $instacia->config["db"],
            $instacia->config["charset"]);
            
            self::$conexion = new PDO(
                $config,
                $instacia->config["usuario"],
                $instacia->config["contrasena"]
            );
        }
        return self::$conexion;
    }
}
?>