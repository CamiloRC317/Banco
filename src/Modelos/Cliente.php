<?php 
declare(strict_types=1);
namespace App\Modelos;
class Cliente{
    public function __construct(
        private readonly int $id,
        private readonly string $nombre)
    {}

    //getter
    public function getId():int{
        return $this->id;
    }
    public function getNombre():string{
        return $this->nombre;
    }

}

?>