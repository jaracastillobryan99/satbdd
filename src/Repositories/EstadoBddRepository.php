<?php
namespace App\Repositories;

use PDO;
use Throwable;

class EstadoBddRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Chequea si la conexión a la base de datos está activa.
     */
    public function testConexion(): array
    {
        try {
            $this->pdo->query('SELECT 1');
            return ['ok' => true, 'mensaje' => 'Conexión a la base de datos exitosa'];
        } catch (Throwable $e) {
            return ['ok' => false, 'mensaje' => $e->getMessage()];
        }
    }

    /**
     * Podrías añadir otros métodos relacionados con la base de datos.
     */
    public function getVersionSistema(): string
    {
        return '1.0.0'; // luego podría venir desde una tabla de config o metadata
    }
}
