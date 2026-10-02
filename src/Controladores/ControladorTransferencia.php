<?php
declare(strict_types=1);
namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Servicios\Excepciones\CuentaNoEncontradaException;
use App\Servicios\ServicioCuenta;
use App\Servicios\Excepciones\SaldoInsuficienteException;
use App\Servicios\Excepciones\CuentaDestinoNoValidaException;

class ControladorTransferencia extends ControladorBase{
    private ServicioCuenta $servicioCuenta;

    public function __construct()
    {
        $this->servicioCuenta = new ServicioCuenta();
    }
    public function formulario():void{
        $this->verificarSesion();
        $this->renderizar("transferencia/formulario");
    }
    public function procesar():void{
        $this->verificarSesion();

        $cuenta_id = $_SESSION['cuenta_id'];
        $valor = (float) $_POST['valor'];
        $numero_cuenta_destino = $_POST['numero_cuenta_destino'];

        try {
            $this->servicioCuenta->transferencia($cuenta_id,$numero_cuenta_destino,$valor);
            header("Location: /");
            exit;
        } catch (CuentaNoEncontradaException $e) {
            $this->renderizar('transferencia/formulario', ['error' => 'Cuenta destino no encontrada']);
        } catch (SaldoInsuficienteException $e) {
            $this->renderizar('transferencia/formulario', ['error' => 'Saldo insuficiente para esta transferencia']);
        }catch (CuentaDestinoNoValidaException $e){
            $this->renderizar('transferencia/formulario', ['error' => 'No se puede enviar a su misma cuenta']);
        }
    }
    public function historial():void{
        $this->verificarSesion();
        $cuenta_id=$_SESSION["cuenta_id"];
        $datos = $this->servicioCuenta->historialTransferencias($_SESSION["cuenta_id"]);
        $this->renderizar("transferencia/historial",["transferencias"=>$datos,"cuenta_id"=>$cuenta_id]);
        
    }
}