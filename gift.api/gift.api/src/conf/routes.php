<?php
declare(strict_types=1);

use gift\api\app\actions\GetCategoriesAction;
use gift\api\app\actions\GetPrestationsAction;
use gift\api\app\actions\GetPrestationsByCatAction;
use Slim\App;

return function(App $app): App {

    // ### Route de l'Api ###
    $app->get('/api/categories', GetCategoriesAction::class)->setName('api.categories');
    $app->get('/api/prestations', GetPrestationsAction::class)->setName('api.prestations');
    $app->get('/api/categories/{id}/prestations', GetPrestationsByCatAction::class)->setName('api.prestationsByCat');
    $app->get('/api/boxs/{id}', \gift\api\app\actions\GetBoxbyId::class)->setName('api.box');

    return $app;

};