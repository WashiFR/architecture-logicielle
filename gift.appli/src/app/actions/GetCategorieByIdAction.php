<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetCategorieByIdAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int)$args['id'];

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune catégorie sélectionnée');

        $sql = Categorie::select('id', 'libelle', 'description')->where('id', $id)->get();

        if ($sql->isEmpty()) throw new HttpNotFoundException($request, 'Erreur 404 : Aucune catégorie trouvée');

        $view = Twig::fromRequest($request);
        $routeContext = RouteContext::fromRequest($request);

        $routeParser = $routeContext->getRouteParser();
        foreach ($sql as $categorie) {
            foreach ($categorie->prestations as $prestation) {
                $prestation->url = $routeParser->urlFor('prestation', [], ['id' => $prestation->id]);
            }
        }

        return $view->render($response, 'CategorieByIdView.twig', ['categories' => $sql]);
    }
}