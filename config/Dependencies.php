<?php
use Psr\Container\ContainerInterface;
use App\Repositories\EstadoBddRepository;
use App\Services\EstadoBddService;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;






return [
    
    // 🗄️ Conexión a la base de datos
    PDO::class => function (ContainerInterface $c) {
        $dsn = $_ENV['DB_DSN'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    },

     // 🧩 Twig View Template
    Twig::class => function () {
        $twig = Twig::create(__DIR__ . '/../views', [
            'cache' => false, // true si quieres usar caché
        ]);
        return $twig;
    },

    
    // 📦 Repositorios
    EstadoBddRepository::class => function (ContainerInterface $c) {
        return new EstadoBddRepository($c->get(PDO::class));
    },
    
    // 🧠 Servicios
    EstadoBddService::class => function (ContainerInterface $c) {
        return new EstadoBddService($c->get(EstadoBddRepository::class));
    },
    
    
];
