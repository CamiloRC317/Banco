<?php 
namespace App\Nucleo;
abstract class ControladorBase{
    protected function verificarSesion():void{
        if(!isset($_SESSION["cuenta_id"])){
            header('Location: /login');
            exit;
        }
    }
    protected function renderizar(string $vista, array $datos = []):void{
        extract($datos);
        require __DIR__ . "/../../vistas/{$vista}.php";
    }
}
?>