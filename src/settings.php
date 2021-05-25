<?php

use Dotenv\Dotenv;
use Monolog\Logger;

// Define root path
defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
defined('ROOT') ?: define('ROOT', dirname(__DIR__) . DS);

// Load .env file
if (file_exists(ROOT . '.env')) {
    $dotenv = Dotenv::parse(file_get_contents(ROOT.'.env'));
}

return [
    'settings' => [
        'displayErrorDetails' => $dotenv['APP_DEBUG'] === 'true',
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // App Settings
        'app' => [
            'name' => $dotenv['APP_NAME'],
            'url' => $dotenv['APP_URL'],
            'env' => $dotenv['APP_ENV'],
        ],

        // Renderer settings
        'view' => [
            'template_path' => __DIR__.'/../templates/',
            'cache' => __DIR__.'/../var/cache/twig/',
            'auto_reload' => $dotenv['APP_DEBUG'] === 'true',
            'extension' => [
                'assets' => [
                    'path' => __DIR__.'/../public/assets',
                    'path_chmod' => 0755,
                    'url_base_path' => 'assets/',
                    'cache_path' =>  $dotenv['APP_DEBUG'] === 'true' ? '' : __DIR__.'/../var/cache/twig/',
                    'cache_name' => $dotenv['APP_DEBUG'] === 'true' ? '' : 'assets',
                    'cache_lifetime' => $dotenv['APP_DEBUG'] === 'true' ? 1 : 0,
                    'minify' => $dotenv['APP_DEBUG'] === 'true' ? 0 : 1,
                ]
            ]
        ],

        // Monolog settings
        'logger' => [
            'name' => $dotenv['APP_NAME'],
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../var/logs/app.log',
            'level' => Logger::DEBUG,
        ],

        // Database settings
        'database' => [
            'driver' => $dotenv['DB_CONNECTION'],
            'host' => $dotenv['DB_HOST'],
            'database' => $dotenv['DB_DATABASE'],
            'username' => $dotenv['DB_USERNAME'],
            'password' => $dotenv['DB_PASSWORD'],
            'port' => $dotenv['DB_PORT'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => 'ps_',
        ],

        'cors' => null !== $dotenv['CORS_ALLOWED_ORIGINS'] ? $dotenv['CORS_ALLOWED_ORIGINS'] : '*',
    ],
];
