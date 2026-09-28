<?php 
declare(strict_types=1);
namespace App\Modelos;
class Cuenta{
    public function __construct(
        private readonly int $id,
        private readonly int $cliente_id,
        private readonly string $numero_cuenta,
        private readonly float $saldo)
    {}
    //getter
    public function getId():int{
        return $this->id;
    }
    public function getClienteId():int{
        return $this->cliente_id;
    }
    public function getNumeroCuenta():string{
        return $this->numero_cuenta;
    }
    public function getSaldo():float{
        return $this->saldo;
    }

}
?>