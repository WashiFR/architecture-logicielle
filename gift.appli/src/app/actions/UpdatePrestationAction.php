<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfException;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\IBoxService;
use gift\appli\core\services\catalogue\CatalogueService;
use gift\appli\core\services\catalogue\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class UpdatePrestationAction extends AbstractAction
{
    private IBoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        $data = $request->getParsedBody();

        try {
            CsrfService::check($data['csrf']);
        } catch (CsrfException $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;
        $tarif = $data['tarif'] ?? null;
        $cat_id = $data['cat_id'] ?? null;

        $this->boxService->updatePrestation([
            'id' => $id,
            'libelle' => $libelle,
            'description' => $description,
            'tarif' => $tarif,
            'cat_id' => $cat_id
        ]);

        $routeContext = RouteContext::fromRequest($request);
        $url = $routeContext->getRouteParser()->urlFor('prestation');
        $url = $url . '?id=' . $id;
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}