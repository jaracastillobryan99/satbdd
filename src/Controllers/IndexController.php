<?php
namespace App\Controllers;

use App\Services\IndexService;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class IndexController
{
    private IndexService $indexService;
    private Twig $twig;

    public function __construct(IndexService $indexService, Twig $twig)
    {
        $this->indexService = $indexService;
        $this->twig = $twig;
    }

    public function home(Request $request, Response $response): Response
    {
        // Simple response for the home route
        $data = [
            'nombre' => 'SATBDD - Sistema de Admisión Técnico Base de Datos',
            'version' => '1.0.0',
            'estado' => 'activo',
            'entorno' => $_ENV['APP_ENV'] ?? 'desarrollo',
            'fecha' => date('Y-m-d H:i:s'),
        ];

        return $this->twig->render($response,'home.twig', $data);

    }

    public function getVersion(Request $request, Response $response): Response
    {
        $resultado = $this->indexService->checkConexion();
        $response->getBody()->write(json_encode($resultado, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
