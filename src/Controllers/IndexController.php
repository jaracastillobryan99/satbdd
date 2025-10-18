<?php
namespace App\Controllers;

use App\Services\IndexService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class IndexController
{
    private IndexService $indexService;

    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    public function home(Request $request, Response $response): Response
    {
        // Simple response for the home route
        $sistema = [
            'nombre' => 'SATBDD - Sistema de Admisión Técnico Base de Datos',
            'version' => '1.0.0',
            'estado' => 'activo',
            'entorno' => $_ENV['APP_ENV'] ?? 'desarrollo',
            'fecha' => date('Y-m-d H:i:s'),
        ];

        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{$sistema['nombre']}</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background: #f8fafc;
                    color: #333;
                    text-align: center;
                    padding-top: 80px;
                }
                h1 {
                    color: #1e40af;
                }
                .card {
                    display: inline-block;
                    background: white;
                    padding: 2rem;
                    border-radius: 12px;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                    min-width: 340px;
                    text-align: left;
                }
                .meta {
                    font-size: 0.9rem;
                    color: #666;
                }
                .rutas {
                    margin-top: 1.2rem;
                    font-size: 0.95rem;
                }
                code {
                    background: #eef;
                    padding: 2px 5px;
                    border-radius: 4px;
                }
            </style>
        </head>
        <body>
            <h1>🚀 {$sistema['nombre']}</h1>
            <div class="card">
                <p><strong>Versión:</strong> {$sistema['version']}</p>
                <p><strong>Estado:</strong> {$sistema['estado']}</p>
                <p><strong>Entorno:</strong> {$sistema['entorno']}</p>
                <p class="meta">Última actualización: {$sistema['fecha']}</p>
                <div class="rutas">
                    <p><strong>Servicios disponibles:</strong></p>
                    <ul>
                        <li><code>/estadobdd</code> → Estado de la base de datos</li>
                        <li><code>/estadobdd/version</code> → Versión del servicio</li>
                    </ul>
                </div>
            </div>
        </body>
        </html>
        HTML;

        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html');
    }

    public function getVersion(Request $request, Response $response): Response
    {
        $resultado = $this->indexService->checkConexion();
        $response->getBody()->write(json_encode($resultado, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
