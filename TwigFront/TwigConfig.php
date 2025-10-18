<?php
namespace App\TwigFront;

class TwigConfig
{
    public static function getSettings(): array
    {
        $env = $_ENV['APP_ENV'] ?? 'desarrollo';

        // Configuraciones comunes de Twig 
        return [
            'paths' => __DIR__ . '/../views',
            'cache_enabled' => ($env === 'produccion'),
            'cache_path' => __DIR__ . '/../cache/twig',
            'debug' => ($env !== 'produccion'),
            'functions_path' => __DIR__ . '/functions',
            'assets' => [
                'js_path' => '/assets/js/',
                'css_path' => '/assets/css/',
                'img_path' => '/assets/img/',
            ]
        ];
    }
}
