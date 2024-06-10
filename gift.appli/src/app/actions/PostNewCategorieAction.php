<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfException;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\catalogue\CatalogueService;
use gift\appli\core\services\catalogue\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

class PostNewCategorieAction extends AbstractAction
{
    private ICatalogueService $catalogueService;

    public function __construct()
    {
        $this->catalogueService = new CatalogueService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();

        try {
            CsrfService::check($data['csrf']);
        } catch (CsrfException $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;

        $this->catalogueService->createCategorie([
            'libelle' => $libelle,
            'description' => $description
        ]);

        $routeContext = RouteContext::fromRequest($request);
        $url = $routeContext->getRouteParser()->urlFor('categories');
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}