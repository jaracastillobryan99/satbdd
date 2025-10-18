<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\EstadoBddController;

return function (App $app) {
    // Grupo de rutas para /estadobdd

    $app->group('/estadobdd', function (RouteCollectorProxy $group) {
        $group->get('/', [EstadoBddController::class, 'checkEstado']);
        $group->get('/version', [EstadoBddController::class, 'getVersion']);
    });
    echo "Rutas 'check' cargadas ---  ";
};
