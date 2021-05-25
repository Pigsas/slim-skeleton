<?php

use Slim\App;

require '../vendor/autoload.php';

$settings = require __DIR__ . '/../src/settings.php';
$app = new App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

$app->run();
