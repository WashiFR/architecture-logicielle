<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class UpdatePrestationAction extends AbstractAction
{
    private string $template;
    private ICatalogueService $catalogueService;

    public function __construct()
    {
        $this->template = 'UpdatePrestationView.twig';
        $this->catalogueService = new CatalogueService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;
        $tarif = $data['tarif'] ?? null;
        $cat_id = $data['cat_id'] ?? null;

        $this->catalogueService->updatePrestation([
            'id' => $id,
            'libelle' => $libelle,
            'description' => $description,
            'tarif' => $tarif,
            'cat_id' => $cat_id
        ]);

        $view = Twig::fromRequest($request);
        return $view->render($response, $this->template, ['prestation' => $libelle]);
    }
}