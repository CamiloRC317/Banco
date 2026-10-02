<?php
declare(strict_types=1);
namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Servicios\ServicioCuenta;
use App\Servicios\Excepciones\SaldoInsuficienteException;
use App\Servicios\Excepciones\contrasenaIncorrecta;

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
        $contraseña = $_POST['contrasena'];
        $valor = (float) $_POST['valor'];

        try {
            $this->servicioCuenta->retirar($cuenta_id,$valor,$contraseña);
            header("Location: /");
            exit;
        } catch (SaldoInsuficienteException $e) {
            $this->renderizar('retiro/formulario', ['error' => 'Saldo insuficiente para este retiro']);
        }catch (contrasenaIncorrecta $e){
            $this->renderizar('retiro/formulario', ['error' => 'Contraseña incorrecta']);
        }
    }
    public function historial():void{
        $this->verificarSesion();
        $datos = $this->servicioCuenta->historialRetiros($_SESSION["cuenta_id"]);
        $this->renderizar("retiro/historial",["retiros"=>$datos]);
        
    }
}