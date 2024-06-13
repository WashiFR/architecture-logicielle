<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceNotFoundException;
use gift\appli\core\services\box\IBoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetBoxesAction extends AbstractAction
{
    private string $template;
    private IBoxService $boxService;

    public function __construct()
    {
        $this->template = 'BoxesView.twig';
        $this->boxService = new BoxService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $box = $this->boxService->getBoxFromUserId($_SESSION['user_id']);
        } catch (BoxServiceNotFoundException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        $routeContext = RouteContext::fromRequest($request);

        $routeParser = $routeContext->getRouteParser();
        for ($i = 0; $i < count($box); $i++) {
            $box[$i]['url'] = $routeParser->urlFor('box', [], ['id' => $box[$i]['id']]);
        }

        return $view->render($response, $this->template, ['boxes' => $box]);
    }
}