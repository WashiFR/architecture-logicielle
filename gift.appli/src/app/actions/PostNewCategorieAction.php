<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceNotFoundException;
use gift\appli\core\services\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class PostNewCategorieAction extends AbstractAction
{
    private string $template;
    private ICatalogueService $catalogueService;

    public function __construct()
    {
        $this->template = 'NewCategorieCreatedView.twig';
        $this->catalogueService = new CatalogueService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;

        $categ_id = $this->catalogueService->createCategorie([
            'libelle' => $libelle,
            'description' => $description
        ]);

        try {
            $categ = $this->catalogueService->getCategorieById($categ_id);
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, $this->template, ['categorie' => $categ[0]]);
    }
}