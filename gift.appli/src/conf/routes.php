<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use gift\appli\app\classes\RoutesFunctions;

return function(App $app): App {
    /* home */

    $app->get('/categories[/]', function(Request $request, Response $response, array $args): Response {
        $response->getBody()->write(RoutesFunctions::getCategories());
        return $response;
    });

    $app->get('/categorie/{id}', function(Request $request, Response $response, array $args): Response {
        $response->getBody()->write(RoutesFunctions::getCategoriesById((int)$args['id']));
        return $response;
    });

    $app->get('/prestation[/]', function(Request $request, Response $response, array $args): Response {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;
        if ($id) {
            $response->getBody()->write(RoutesFunctions::getPrestationById((int)$id));
        } else {
            $response->getBody()->write('Erreur : Aucune prestation sélectionnée');
        }
        return $response;
    });

    $app->get('/box/create', function(Request $request, Response $response, array $args): Response {
        $response->getBody()->write(RoutesFunctions::formCreateNewBox());
        return $response;
    });

    $app->post('/box/create', function(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;
        $montant = $data['montant'] ?? null;
        $response->getBody()->write(RoutesFunctions::createNewBox($libelle, $description, (int) $montant));
        return $response;
    });

    return $app;

};