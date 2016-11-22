<?php

use Igorw\Silex\ConfigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Silex\Application();
$app->register(new ConfigServiceProvider(__DIR__ . '/config/config.yml'));
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__ . '/../resources/db/app.db'
    ]
]);

return $app;
