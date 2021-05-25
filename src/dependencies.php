<?php
// DIC configuration

use Illuminate\Database\Capsule\Manager;
use Odan\Twig\TwigAssetsCache;
use Odan\Twig\TwigAssetsExtension;
use Slim\Views\Twig;

$container = $app->getContainer();


// Error Handler


// App Service Providers


// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

// database
$container['database'] = function ($c) {
    $capsule = new Manager;
    $capsule->addConnection($c->get('settings')['database']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

// view
$container['view'] = function ($c) {
    $settings = $c->get('settings')['view'];
    $view = new Twig($settings['template_path'], [
        'cache' => $settings['cache'],
        'auto_reload' => $settings['auto_reload'],
    ]);

    $view->addExtension(new TwigAssetsExtension($view->getEnvironment(), $settings['extension']['assets']));

    if (empty($settings['extension']['assets']['cache_path'])){
        $internalCache = new TwigAssetsCache($settings['extension']['assets']['path']);
        $internalCache->clearCache();
    }

    return $view;
};