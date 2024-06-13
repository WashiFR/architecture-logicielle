<?php

use gift\appli\infrastructure\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

session_start();

$app = AppFactory::create();
Eloquent::init(__DIR__ . '/conf.ini');

// Twig
$twig = Twig::create(__DIR__ . '/../app/views', [
    'cache' => __DIR__ . '/cache',
    'auto_reload' => true
]);

$twig->getEnvironment()->addGlobal('globals', [
    'img_dir' => '../src/img/',
    'user_id' => $_SESSION['user_id'] ?? null,
    'user_role' => $_SESSION['user_role'] ?? null
]);

$app->add(TwigMiddleware::create($app, $twig));

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('/gift.appli/public');

$app=(require_once __DIR__ . '/routes.php')($app);

return $app;