<?php
namespace App\Services;

use App\Repositories\IndexRepository;

class IndexService
{
    private IndexRepository $repo;

    public function __construct(IndexRepository $repo)
    {
        $this->repo = $repo;
    }

    public function checkConexion(): array
    {
        $resultado = $this->repo->testConexion();

        if ($resultado['ok']) {
            return [
                'estado' => 'ok',
                'conexion' => 'conectado a la base de datos satbdd'
            ];
        } else {
            return [
                'estado' => 'error',
                'conexion' => 'fallo en la conexión',
                'detalle' => $resultado['mensaje']
            ];
        }
    }

    public function getVersion(): array
    {
        return [
            'version' => $this->repo->getVersionSistema(),
            'descripcion' => 'Chequeo de estado de la base de datos'
        ];
    }
}
