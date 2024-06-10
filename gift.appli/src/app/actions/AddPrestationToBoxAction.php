<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\IBoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class AddPrestationToBoxAction extends AbstractAction
{
    private IBoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        $prestationId = $data['presta_id'];
        $boxId = $data['box_id'];

        $this->boxService->addPrestationToBox($prestationId, $boxId);

        $routeContext = RouteContext::fromRequest($request);
        $url = $routeContext->getRouteParser()->urlFor('prestation');
        $url = $url . '?id=' . $prestationId;
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}