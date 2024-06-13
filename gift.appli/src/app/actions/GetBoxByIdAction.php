<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\domain\Prestation;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceNotFoundException;
use gift\appli\core\services\box\IBoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetBoxByIdAction extends AbstractAction
{
    private string $template;
    private IBoxService $boxService;

    public function __construct()
    {
        $this->template = 'BoxByIdView.twig';
        $this->boxService = new BoxService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune box sélectionnée');

        try {
            $box = $this->boxService->getBoxById($id);
            $prestations = $this->boxService->getPrestationByBoxId($id);
        } catch (BoxServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        $routeContext = RouteContext::fromRequest($request);

        $routeParser = $routeContext->getRouteParser();
        for ($i = 0; $i < count($prestations); $i++) {
            $prestations[$i]['url'] = $routeParser->urlFor('prestation', [], ['id' => $prestations[$i]['id']]);
        }

        return $view->render($response, $this->template, [
            'boxes' => $box,
            'prestations' => $prestations
        ]);
    }
}