<?php
declare(strict_types=1);
namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Servicios\ServicioAutenticacion;

class ControladorAutenticacion extends ControladorBase
{
    private ServicioAutenticacion $servicioAutenticacion;

    public function __construct()
    {
        $this->servicioAutenticacion=new ServicioAutenticacion();
    }

    public function mostrarLogin(): void
    {
        $this->renderizar("autenticacion/login");
    }

    public function procesarLogin(): void
    {
        $numero_cuenta = $_POST["numero_cuenta"];
        $clave = $_POST["clave"];

        $usuario=$this->servicioAutenticacion->validarLogin($numero_cuenta,$clave);
        if ($usuario !== null) {
            $_SESSION['cuenta_id'] = $usuario->getCuentaId();
            header('Location: /');
            exit;
        }
        $this->renderizar("autenticacion/login", ["error" => "Cuenta o contraseña incorrectos"]);   
    }
    public function salir(): void
    {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}