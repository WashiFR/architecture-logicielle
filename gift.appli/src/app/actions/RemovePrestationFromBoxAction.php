<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\IBoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class RemovePrestationFromBoxAction extends AbstractAction
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

        $this->boxService->removePrestationFromBox($prestationId, $boxId);

        $routeContext = RouteContext::fromRequest($request);
        $url = $routeContext->getRouteParser()->urlFor('box');
        $url = $url . '?id=' . $boxId;
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}