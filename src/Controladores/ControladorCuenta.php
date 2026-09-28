<?php
namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Servicios\ServicioCuenta;

class ControladorCuenta extends ControladorBase
{
    private ServicioCuenta $servicioCuenta;

    public function __construct()
    {
        $this->servicioCuenta = new ServicioCuenta();
    }

    public function panel(): void
    {
        $this->verificarSesion();
        $cuenta_id = $_SESSION["cuenta_id"];
        $saldo = $this->servicioCuenta->consultarSaldo($cuenta_id);
        $this->renderizar('cuenta/panel', ['saldo' => $saldo]);
    }
}