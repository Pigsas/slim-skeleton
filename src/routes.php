<?php

use App\Controllers\HomeController;

$app->group('/',
    function () {
        $this->get('', HomeController::class . ':index')->setName('home.index');
    }
);