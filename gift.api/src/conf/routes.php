<?php
declare(strict_types=1);

use gift\api\app\actions\GetCategoriesAction;
use Slim\App;

return function(App $app): App {

    // ### Route de l'Api ###
    $app->get('/api/categories', GetCategoriesAction::class)->setName('api.categories');

    return $app;

};