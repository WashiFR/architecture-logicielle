<?php
declare(strict_types=1);

use Slim\App;
use \gift\appli\app\actions\GetCategoriesAction;
use \gift\appli\app\actions\GetCategorieByIdAction;
use \gift\appli\app\actions\GetPrestationByIdAction;
use \gift\appli\app\actions\GetFormNewBoxAction;
use \gift\appli\app\actions\PostNewBoxAction;

return function(App $app): App {
    /* home */

    $app->get('/categories[/]', GetCategoriesAction::class);

    $app->get('/categorie/{id}', GetCategorieByIdAction::class);

    $app->get('/prestation[/]', GetPrestationByIdAction::class);

    $app->get('/box/create', GetFormNewBoxAction::class);

    $app->post('/box/create', PostNewBoxAction::class);

    return $app;

};