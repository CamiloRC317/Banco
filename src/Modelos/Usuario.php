<?php
declare(strict_types=1);
namespace App\Modelos;
class Usuario
{
    public function __construct(
        private readonly int $id,
        private readonly int $cuenta_id,
        private readonly string $contraseña_hash
    ) {}

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getCuentaId(): int
    {
        return $this->cuenta_id;
    }
    public function getContraseñaHash(): string{
        return $this->contraseña_hash;
    }
}
?>d