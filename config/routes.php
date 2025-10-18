<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\IndexController;

return function (App $app) {
    // Ruta raíz para comprobar funcionamiento
    $app->get('/', [IndexController::class, 'home']);


    
    // Incluir rutas específicas de servicios
    (require __DIR__ . '/routesCheckServices.php')($app);
    
};
