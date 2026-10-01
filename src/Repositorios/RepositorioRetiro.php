<?php 
declare(strict_types=1);
namespace App\Repositorios;
use App\Modelos\Retiro;
use App\Nucleo\Conexion;
use DateTime;
use PDO;
class RepositorioRetiro{
    private PDO $conexion;
    public function __construct(){
        $this->conexion=Conexion::obtenerConexion();
    }
    public function obtenerRetiros(int $cuenta_id): array{
        $sql="SELECT * FROM retiros WHERE cuenta_id=:cuenta_id";
        $stmt=$this->conexion->prepare($sql);
        $stmt->execute(["cuenta_id"=>$cuenta_id]);
        $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $retiros = [];
        foreach($filas as $fila){
            $instancia = new Retiro(
                (int) $fila["id"],
                (int) $fila["cuenta_id"],
                (float) $fila["valor"],
                new DateTime($fila["fecha"]));
            $retiros[]=$instancia;
        }
        return $retiros;
    }
    public function registrar(int $cuenta_id,float $valor):void{
        $sql = "INSERT INTO retiros(cuenta_id,valor) VALUES(:cuenta_id,:valor)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["cuenta_id"=>$cuenta_id,"valor"=>$valor]);
    }
}
?>