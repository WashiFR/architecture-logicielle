<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceNotFoundException;
use gift\appli\core\services\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetCategorieByIdAction extends AbstractAction
{
    private string $template;
    private ICatalogueService $catalogueService;

    public function __construct()
    {
        $this->template = 'CategorieByIdView.twig';
        $this->catalogueService = new CatalogueService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int)$args['id'];

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune catégorie sélectionnée');

        try {
            $sql = $this->catalogueService->getCategorieById($id);
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        $routeContext = RouteContext::fromRequest($request);

        $routeParser = $routeContext->getRouteParser();
        foreach ($sql as $key => $categorie) {
            foreach ($categorie['prestations'] as $key2 => $prestation) {
                $sql[$key]['prestations'][$key2]['url'] = $routeParser->urlFor('prestation', [], ['id' => $prestation['id']]);
            }
        }

        return $view->render($response, $this->template, ['categories' => $sql]);
    }
}