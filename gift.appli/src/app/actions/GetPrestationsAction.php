<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\Prestation;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceNotFoundException;
use gift\appli\core\services\ICatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetPrestationsAction extends AbstractAction
{
    private string $template;
    private ICatalogueService $catalogueService;

    public function __construct()
    {
        $this->template = 'PrestationsView.twig';
        $this->catalogueService = new CatalogueService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $sql = $this->catalogueService->getPrestations();
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        $routeContext = RouteContext::fromRequest($request);

        $routeParser = $routeContext->getRouteParser();
        for ($i = 0; $i < count($sql); $i++) {
            $sql[$i]['url'] = $routeParser->urlFor('prestation', [], ['id' => $sql[$i]['id']]);
        }

        return $view->render($response, $this->template, ['prestations' => $sql]);
    }
}