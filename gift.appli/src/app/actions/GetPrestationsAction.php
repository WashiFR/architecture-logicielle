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
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetPrestationsAction extends AbstractAction
{
    private string $template;
    private IBoxService $boxService;

    public function __construct()
    {
        $this->template = 'PrestationsView.twig';
        $this->boxService = new BoxService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $sql = $this->boxService->getPrestations();
        } catch (BoxServiceNotFoundException $e) {
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