<?php 
declare(strict_types=1);
namespace App\Modelos;
use DateTime;
class Retiro{
    public function __construct(
        private readonly int $id,
        private readonly int $cuenta_id,
        private readonly float $valor,
        private readonly DateTime $fecha)
    {}
    //Getter
    public function getId():int{
        return $this->id;
    }
    public function getCuentaId():int{
        return $this->cuenta_id;
    }
    public function getValor() : float{
        return $this->valor;
    }
    public function getFecha():DateTime{
        return $this->fecha;
    }

}
?>