<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceNotFoundException;
use gift\appli\core\services\box\IBoxService;
use gift\appli\core\services\catalogue\CatalogueService;
use gift\appli\core\services\catalogue\CatalogueServiceNotFoundException;
use gift\appli\core\services\catalogue\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetPrestationByIdAction extends AbstractAction
{
    private string $template;
    private ICatalogueService $catalogueService;
    private IBoxService $boxService;

    public function __construct()
    {
        $this->template = 'PrestationByIdView.twig';
        $this->catalogueService = new CatalogueService();
        $this->boxService = new BoxService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune prestation sélectionnée');

        try {
            $sql = $this->boxService->getPrestationById($id);
            $categ = $this->catalogueService->getCategorieById($sql[0]['cat_id']);
        } catch (CatalogueServiceNotFoundException|BoxServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $routeContext = RouteContext::fromRequest($request);

        $routeParser = $routeContext->getRouteParser();
        for ($i = 0; $i < count($categ); $i++) {
            $categ[$i]['url'] = $routeParser->urlFor('categorie', ['id' => $categ[$i]['id']]);
            $edit[$i]['url'] = $routeParser->urlFor('prestation.edit', [], ['id' => $sql[$i]['id']]);
        }

        $box_id = $_SESSION['box_id'] ?? null;

        $views = Twig::fromRequest($request);
        return $views->render($response, $this->template, [
            'prestations' => $sql,
            'categorie' => $categ[0],
            'edit' => $edit[0],
            'box_id' => $box_id
        ]);
    }
}