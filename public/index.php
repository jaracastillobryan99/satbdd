<?php 
declare(strict_types=1);
 

// 1.- autoload y librerias 
require __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;



//1.1  Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();


//2. - Crear contenedor de dependencias [CONTAINER -- PHP-DI]
//2.1 -construir contenedor

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config/Dependencies.php');
$containerBuilder->addDefinitions(__DIR__ . '/../config/DependenciesApp.php');

$container = $containerBuilder->build();


echo "1.- Antes de crear el contenedor de la app slim ----- ";

//3. - crear app SLIM

AppFactory::setContainer($container);
$app = AppFactory::create();

//3.1 definir el basepath sin .env
// 3.1 - Definir el base path automáticamente (funciona en XAMPP)
$basePath = $_ENV['BASE_PATH'] ?? '';
$app->setBasePath($basePath);
echo "2.- se crea el contenedor y la ruta de base path ----- ";

//4. - middlewares para procesasr json y formularios
$app->addBodyParsingMiddleware();

//4.1 -midleware de enrutamiento (interno de slim)
$app->addRoutingMiddleware();
//4.2 - midleware de manejo de errores (interno de slim)
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

//5.- cargar rutas de la app que estan en el fichero routes.php
(require __DIR__ . '/../config/routes.php')($app);
echo "4.- cargan las rutas   \n";

//6.- ejecutar app
$app->run();
echo "hola estoy al final  despes de app run en index.php";

// fin de index.php
?>