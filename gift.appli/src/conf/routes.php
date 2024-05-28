<?php
declare(strict_types=1);

use gift\appli\app\actions\GetPrestationsAction;
use gift\appli\app\actions\ShowHomeAction;
use Slim\App;
use \gift\appli\app\actions\GetCategoriesAction;
use \gift\appli\app\actions\GetCategorieByIdAction;
use \gift\appli\app\actions\GetPrestationByIdAction;
use \gift\appli\app\actions\GetFormNewBoxAction;
use \gift\appli\app\actions\PostNewBoxAction;

return function(App $app): App {

    $app->get('/', ShowHomeAction::class)->setName('home');

    $app->get('/categories[/]', GetCategoriesAction::class)->setName('categories');

    $app->get('/categorie/{id}', GetCategorieByIdAction::class)->setName('categorie');

    $app->get('/prestations[/]', GetPrestationsAction::class)->setName('prestations');

    $app->get('/prestation', GetPrestationByIdAction::class)->setName('prestation');

    $app->get('/box/create', GetFormNewBoxAction::class)->setName('box.create');

    $app->post('/box/create', PostNewBoxAction::class)->setName('box.create');

    return $app;

};