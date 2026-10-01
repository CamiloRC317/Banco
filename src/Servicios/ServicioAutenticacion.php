<?php 
declare(strict_types=1);
namespace App\Servicios;
use App\Repositorios\RepositorioUsuario;
use App\Modelos\Usuario;
class ServicioAutenticacion{
    private RepositorioUsuario $repositorioUsuario;
    public function __construct(){
        $this->repositorioUsuario = new RepositorioUsuario();
    }
    public function validarLogin(string $numero_cuenta,string $contraseña):?Usuario{
       $usuario = $this->repositorioUsuario->buscarPorNumeroDeCuenta($numero_cuenta);
       if($usuario==null){
            return null;
       }
       if(!password_verify($contraseña,$usuario->getContraseñaHash())){
            return null;
       }
       return $usuario;
       
        
    }
}
?>