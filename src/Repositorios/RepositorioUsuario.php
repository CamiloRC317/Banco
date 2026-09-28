<?php
namespace App\Repositorios;
use App\Modelos\Usuario;
use App\Nucleo\Conexion;
use PDO;
class RepositorioUsuario
{
    private PDO $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::obtenerConexion();
    }
    public function buscarPorNumeroDeCuenta(string $numero_cuenta): ?Usuario
    {
        $sql = "SELECT u.id, u.cuenta_id, u.clave_hash
                    FROM usuarios u
                    INNER JOIN cuentas c ON c.id = u.cuenta_id
                    WHERE c.numero_cuenta = :numero_cuenta";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["numero_cuenta" => $numero_cuenta]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila == false) {
            return null;
        }
        return new Usuario(
            (int) $fila["id"],
            (int) $fila["cuenta_id"],
            $fila["clave_hash"]
        );
    }
}
?>