<?php
declare(strict_types=1);
namespace App\Repositorios;
use App\Modelos\Transferencia;
use App\Nucleo\Conexion;
use DateTime;
use PDO;
class RepositorioTransferencia
{
    private PDO $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::obtenerConexion();
    }
    public function obtenerTransferencias(int $cuenta_id):array
    {
        $sql = "SELECT * FROM transferencias 
        WHERE cuenta_origen_id = :cuenta_id 
        OR cuenta_destino_id = :cuenta_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            "cuenta_id" => $cuenta_id
        ]);
        $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $transferencias = [];
        foreach ($filas as $fila) {
            $instancia = new Transferencia(
                (int) $fila["id"],
                (int) $fila["cuenta_origen_id"],
                (int) $fila["cuenta_destino_id"],
                (float) $fila["valor"],
                new DateTime($fila["fecha"])
            );
            $transferencias[] = $instancia;
        }
        return $transferencias;

    }
    public function registrar(int $cuenta_origen_id,int $cuenta_destino_id,float $valor):void{
        $sql = "INSERT INTO 
        transferencias(cuenta_origen_id,cuenta_destino_id,valor)
        VALUES(:cuenta_origen_id,:cuenta_destino_id,:valor)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["cuenta_origen_id"=>$cuenta_origen_id,
        "cuenta_destino_id"=>$cuenta_destino_id,
        "valor"=>$valor]);
    }
}
?>
