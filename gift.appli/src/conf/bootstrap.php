<?php

use Slim\Factory\AppFactory;
use \gift\appli\app\utils\Eloquent;

$app = AppFactory::create();
Eloquent::init(__DIR__ . '/conf.ini');

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('/gift.appli/public');

$app=(require_once __DIR__ . '/routes.php')($app);

return $app;