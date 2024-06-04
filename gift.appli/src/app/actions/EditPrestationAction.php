<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceNotFoundException;
use gift\appli\core\services\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class EditPrestationAction extends AbstractAction
{
    private string $template;
    private ICatalogueService $catalogueService;

    public function __construct()
    {
        $this->template = 'EditPrestationView.twig';
        $this->catalogueService = new CatalogueService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune prestation sélectionnée');

        try {
            $sql = $this->catalogueService->getPrestationById($id);
            $categories = $this->catalogueService->getCategories();
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $routeContext = RouteContext::fromRequest($request);

        $routeParser = $routeContext->getRouteParser();
        for ($i = 0; $i < count($sql); $i++) {
            $edit[$i]['url'] = $routeParser->urlFor('prestation.edit', [], ['id' => $sql[$i]['id']]);
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, $this->template, [
            'prestation' => $sql[0],
            'edit' => $edit[0],
            'categories' => $categories
        ]);
    }
}