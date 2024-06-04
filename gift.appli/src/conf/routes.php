<?php
declare(strict_types=1);

use gift\appli\app\actions\CreateCategorieAction;
use gift\appli\app\actions\EditPrestationAction;
use gift\appli\app\actions\GetPrestationsAction;
use gift\appli\app\actions\PostNewCategorieAction;
use gift\appli\app\actions\ShowHomeAction;
use gift\appli\app\actions\UpdatePrestationAction;
use Slim\App;
use \gift\appli\app\actions\GetCategoriesAction;
use \gift\appli\app\actions\GetCategorieByIdAction;
use \gift\appli\app\actions\GetPrestationByIdAction;
use \gift\appli\app\actions\CreateBoxAction;
use \gift\appli\app\actions\PostNewBoxAction;

return function(App $app): App {

    // ### Route de la page d'accueil ###
    $app->get('/', ShowHomeAction::class)->setName('home');

    // ### Routes de Catégories ###
    $app->get('/categories[/]', GetCategoriesAction::class)->setName('categories');
    $app->get('/categorie/{id}', GetCategorieByIdAction::class)->setName('categorie');
    $app->get('/categories/create', CreateCategorieAction::class)->setName('categories.create');
    $app->post('/categories/create', PostNewCategorieAction::class)->setName('categories.create');

    // ### Routes de Prestations ###
    $app->get('/prestations[/]', GetPrestationsAction::class)->setName('prestations');
    $app->get('/prestation', GetPrestationByIdAction::class)->setName('prestation');
    $app->get('/prestation/edit', EditPrestationAction::class)->setName('prestation.edit');
    $app->post('/prestation/edit', UpdatePrestationAction::class)->setName('prestation.edit');

    // ### Routes de Box ###
    $app->get('/box/create', CreateBoxAction::class)->setName('box.create');
    $app->post('/box/create', PostNewBoxAction::class)->setName('box.create');

    return $app;

};