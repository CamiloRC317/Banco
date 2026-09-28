<?php
namespace App\Repositorios;
use App\Modelos\Cuenta;
use App\Nucleo\Conexion;
use PDO;
class RepositorioCuenta
{
    private PDO $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::obtenerConexion();
    }
    public function obtenerCuentaPorId(int $cuenta_id): ?Cuenta
    {
        $sql = "SELECT * FROM cuentas WHERE id = :cuenta_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["cuenta_id" => $cuenta_id]);

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila == false) {
            return null;
        }
        return new Cuenta(
            (int) $fila["id"],
            (int) $fila["cliente_id"],
            $fila["numero_cuenta"],
            (float) $fila["saldo"]
        );
    }
    public function obtenerCuentaPorNumero(string $numero_cuenta){
        $sql = "SELECT * FROM cuentas WHERE numero_cuenta = :numero_cuenta";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["numero_cuenta" => $numero_cuenta]);

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila == false) {
            return null;
        }
        return new Cuenta(
            (int) $fila["id"],
            (int) $fila["cliente_id"],
            $fila["numero_cuenta"],
            (float) $fila["saldo"]
        );
    }
    public function actualizarSaldo(int $cuentaId, float $nuevoSaldo): void
    {
        $sql = "UPDATE cuentas SET saldo = :saldo WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["saldo" => $nuevoSaldo, "id" => $cuentaId]);
    }
}
?>