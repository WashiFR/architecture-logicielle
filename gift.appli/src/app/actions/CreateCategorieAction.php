<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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
        $view = Twig::fromRequest($request);
        return $view->render($response, $this->template, ['csrf' => CsrfService::generate()]);
    }
}