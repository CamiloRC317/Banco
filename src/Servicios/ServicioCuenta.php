<?php 
declare(strict_types=1);
namespace App\Servicios;
use App\Repositorios\RepositorioCuenta;
use App\Repositorios\RepositorioRetiro;
use App\Repositorios\RepositorioTransferencia;
use App\Servicios\Excepciones\CuentaNoEncontradaException;
use App\Servicios\Excepciones\SaldoInsuficienteException;
use App\Nucleo\Conexion;
use Exception;
use PDO;
class ServicioCuenta{
    private RepositorioCuenta $repositorio_cuenta;
    private RepositorioRetiro $repositorio_retiro;
    private RepositorioTransferencia $repositorio_transferencia;
    private PDO $conexion;
    public function __construct(){
        $this->repositorio_cuenta = new RepositorioCuenta();
        $this->repositorio_retiro = new RepositorioRetiro();
        $this->repositorio_transferencia = new RepositorioTransferencia();

        $this->conexion = Conexion::obtenerConexion();
    }
    public function retirar(int $cuenta_id,float $saldo_retirado):void{
        $cuenta = $this->repositorio_cuenta->obtenerCuentaPorId($cuenta_id);
        if($cuenta->getSaldo()<$saldo_retirado){
            throw new SaldoInsuficienteException();
        }
        $saldo_actualizado = $cuenta->getSaldo()-$saldo_retirado;
        $this->repositorio_cuenta->actualizarSaldo($cuenta_id,$saldo_actualizado);
        $this->repositorio_retiro->registrar($cuenta_id,$saldo_retirado);
    }
    public function consultarSaldo(int $cuenta_id){
        $cuenta = $this->repositorio_cuenta->obtenerCuentaPorId($cuenta_id);
        return $cuenta->getSaldo();
    }
    public function transferencia(int $cuenta_origen_id, string $numero_cuenta_destino, float $saldo_transferir):void{
        $this->conexion->beginTransaction();
        try{
            $cuenta_origen = $this->repositorio_cuenta->obtenerCuentaPorId($cuenta_origen_id);
            $cuenta_destino = $this->repositorio_cuenta->obtenerCuentaPorNumero($numero_cuenta_destino);
            if($cuenta_destino==null){
                throw new CuentaNoEncontradaException();
            }

            if($cuenta_origen->getSaldo()<$saldo_transferir){
                throw new SaldoInsuficienteException();
            }
            $saldo_origen = $cuenta_origen->getSaldo()-$saldo_transferir;
            $saldo_destino = $cuenta_destino->getSaldo()+$saldo_transferir;

            $this->repositorio_cuenta->actualizarSaldo($cuenta_origen_id,$saldo_origen);
            $this->repositorio_cuenta->actualizarSaldo($cuenta_destino->getId(),$saldo_destino);

            $this->repositorio_transferencia->registrar($cuenta_origen_id,$cuenta_destino->getId(),$saldo_transferir);

            $this->conexion->commit();

        }catch(Exception $e){
            $this->conexion->rollBack();
            throw $e;
        }
    }
    public function historialRetiros(int $cuenta_id):array{
        return $this->repositorio_retiro->obtenerRetiros($cuenta_id);
    }
    public function historialTransferencias(int $cuenta_id):array{
        return $this->repositorio_transferencia->obtenerTransferencias($cuenta_id);
    }
}
?>