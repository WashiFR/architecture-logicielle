<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\Box;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceNotFoundException;
use gift\appli\core\services\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class PostNewBoxAction extends AbstractAction
{
    private string $template;
    private ICatalogueService $catalogueService;

    public function __construct()
    {
        $this->template = 'NewBoxCreatedView.twig';
        $this->catalogueService = new CatalogueService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;
        $montant = $data['montant'] ?? null;

        $box_id = $this->catalogueService->createBox([
            'libelle' => $libelle,
            'description' => $description,
            'montant' => $montant
        ]);

        try {
            $box = $this->catalogueService->getBoxById($box_id);
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, $this->template, ['box' => $box[0]]);
    }
}