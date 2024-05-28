<?php

use Slim\Factory\AppFactory;
use \gift\appli\app\utils\Eloquent;
use \Slim\Views\Twig;
use \Slim\Views\TwigMiddleware;

$app = AppFactory::create();
Eloquent::init(__DIR__ . '/conf.ini');

// Twig
$twig = Twig::create(__DIR__ . '/../app/views', [
    'cache' => __DIR__ . '/cache',
    'auto_reload' => true
]);

$app->add(TwigMiddleware::create($app, $twig));

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('/gift.appli/public');

$app=(require_once __DIR__ . '/routes.php')($app);

return $app;