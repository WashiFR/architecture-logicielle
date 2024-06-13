<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfService;
use gift\appli\core\domain\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class CreateCategorieAction extends AbstractAction
{
    private string $template;

    public function __construct()
    {
        $this->template = 'FormNewCategorieView.twig';
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $routeContext = RouteContext::fromRequest($request);

        if (!isset($_SESSION['user_role'])) {
            $url = $routeContext->getRouteParser()->urlFor('signin');
            return $response->withStatus(302)->withHeader('Location', $url);
        } else if ($_SESSION['user_role'] != User::ADMIN) {
            $url = $routeContext->getRouteParser()->urlFor('home');
            return $response->withStatus(302)->withHeader('Location', $url);
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, $this->template, ['csrf' => CsrfService::generate()]);
    }
}