<?php
use App\TwigFront\TwigConfig;
use App\TwigFront\TwigServices;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\App;
use Psr\Container\ContainerInterface;

return [

    // Twig (vista principal)
    Twig::class => function (ContainerInterface $container) {
        $settings = TwigConfig::getSettings();
        return TwigServices::create($settings);
    },

    // Middleware de Twig
    TwigMiddleware::class => function (ContainerInterface $container) {
        return TwigMiddleware::createFromContainer(
            $container->get(App::class),
            Twig::class
        );
    },

];
