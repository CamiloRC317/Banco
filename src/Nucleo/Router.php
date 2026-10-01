<?php 
namespace App\Nucleo;
class Router{
    protected array $rutas = [];
    public function registrarRutas(string $method, string $uri, string $controller){
        $this->rutas[]=[
            "method"=>$method,
            "uri"=>$uri,
            "controller"=>$controller
        ];
    }
    public function get(string $uri, string $controller): void
    {
        $this->registrarRutas("GET", $uri, $controller);
    }

    public function post(string $uri, string $controller): void
    {
        $this->registrarRutas("POST", $uri, $controller);
    }
    public function route(string $uri, string $method){
        $uri=parse_url($uri,PHP_URL_PATH);
        $uri = rtrim($uri,"/");
        if($uri == ""){
            $uri = "/";
        }
        foreach($this->rutas as $ruta){
            if($ruta["method"]==$method && $ruta["uri"]==$uri){
                $this->ejecutar($ruta["controller"]);
                return;
            }
        }
        echo "404 - Ruta no encontrada: {$method} {$uri}";
    }
    public function ejecutar(string $controller) : void{
        [$nombre_clase,$accion] = explode("@",$controller);
        $clase_completo = "App\\Controladores\\{$nombre_clase}";
        if(!class_exists($clase_completo)){
            echo "No existe el controlador: {$clase_completo}";
            return;
        }
        $instancia = new $clase_completo();
        if(!method_exists($instancia,$accion)){
            echo "El controlador {$nombre_clase} no tiene el método {$accion}()";
            return;
        }
        $instancia->$accion();
    }
}
?>