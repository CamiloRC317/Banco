<?php
namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Servicios\ServicioCuenta;
use App\Servicios\Excepciones\SaldoInsuficienteException;

class ControladorRetiro extends ControladorBase{
    private ServicioCuenta $servicioCuenta;

    public function __construct()
    {
        $this->servicioCuenta = new ServicioCuenta();
    }
    public function formulario():void{
        $this->verificarSesion();
        $this->renderizar("retiro/formulario");
    }
    public function procesar():void{
        $this->verificarSesion();

        $cuenta_id = $_SESSION['cuenta_id'];
        $valor = (float) $_POST['valor'];

        try {
            $this->servicioCuenta->retirar($cuenta_id,$valor);
            header("Location: /");
            exit;
        } catch (SaldoInsuficienteException $e) {
            $this->renderizar('retiro/formulario', ['error' => 'Saldo insuficiente para este retiro']);
        }
    }
    public function historial():void{
        $this->verificarSesion();
        $datos = $this->servicioCuenta->historialRetiros($_SESSION["cuenta_id"]);
        $this->renderizar("retiro/historial",["retiros"=>$datos]);
        
    }
}