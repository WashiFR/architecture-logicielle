<?php

use gift\api\infrastructure\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

session_start();

$app = AppFactory::create();
Eloquent::init(__DIR__ . '/conf.ini');

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('/gift.api/public');

$app=(require_once __DIR__ . '/routes.php')($app);

return $app;