<?php 
declare(strict_types=1);
namespace App\Modelos;
use DateTime;
class Transferencia
{
    public function __construct(
        private readonly int $id,
        private readonly int $cuenta_origen,
        private readonly int $cuenta_destino,
        private readonly float $valor,
        private readonly DateTime $fecha
    ) {}

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getCuentaOrigen(): int
    {
        return $this->cuenta_origen;
    }

    public function getCuentaDestino(): int
    {
        return $this->cuenta_destino;
    }
    public function getValor() : float{
        return $this->valor;
    }

    public function getFecha(): DateTime
    {
        return $this->fecha;
    }
}
?>