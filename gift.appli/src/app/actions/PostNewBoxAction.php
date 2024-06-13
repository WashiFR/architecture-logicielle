<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfException;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\IBoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

class PostNewBoxAction extends AbstractAction
{
    private IBoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();

        try {
            CsrfService::check($data['csrf']);
        } catch (CsrfException $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $token = $data['csrf'] ?? null;
        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;
        $kdo = $data['kdo'] ?? 0;
        $message_kdo = $data['message_kdo'] ?? null;

        $box_id = $this->boxService->createBox([
            'token' => $token,
            'libelle' => $libelle,
            'description' => $description,
            'kdo' => $kdo,
            'message_kdo' => $message_kdo
        ]);

        $_SESSION['box_id'] = $box_id;

        $routeContext = RouteContext::fromRequest($request);
        $url = $routeContext->getRouteParser()->urlFor('categories');
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}