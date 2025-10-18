<?php
namespace App\TwigFront;

use Slim\Views\Twig;
use Twig\TwigFunction;
use Twig\Extension\DebugExtension;

class TwigServices
{
    public static function create(array $settings): Twig
    {
        $options = [
            'cache' => $settings['cache_enabled'] ? $settings['cache_path'] : false,
            'debug' => $settings['debug'],
        ];

        $twig = Twig::create($settings['paths'], $options);
        $environment = $twig->getEnvironment();

        // 🔹 Funciones Twig personalizadas
        $environment->addFunction(new TwigFunction('js_path', fn() => $settings['assets']['js_path']));
        $environment->addFunction(new TwigFunction('css_path', fn() => $settings['assets']['css_path']));
        $environment->addFunction(new TwigFunction('img_path', fn() => $settings['assets']['img_path']));

        // 🔹 Extensión de depuración (solo si está habilitado)
        if ($settings['debug']) {
            $environment->addExtension(new DebugExtension());
        }

        return $twig;
    }
}
