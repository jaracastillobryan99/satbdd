<?php
namespace App\Controllers;

use App\Services\EstadoBddService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class EstadoBddController
{
    private EstadoBddService $estadoService;

    public function __construct(EstadoBddService $estadoService)
    {
        $this->estadoService = $estadoService;
    }

    public function checkEstado(Request $request, Response $response): Response
    {
        $resultado = $this->estadoService->checkConexion();
        $response->getBody()->write(json_encode($resultado, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus($resultado['estado'] === 'ok' ? 200 : 500);
    }

    public function getVersion(Request $request, Response $response): Response
    {
        $resultado = $this->estadoService->checkConexion();
        $response->getBody()->write(json_encode($resultado, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
