<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PostNewBoxAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? null;
        $description = $data['description'] ?? null;
        $montant = $data['montant'] ?? null;

        $box = new Box;
        $box->libelle = $libelle;
        $box->description = $description;
        $box->montant = $montant;
        $box->save();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'NewBoxCreatedView.twig', ['box' => $box]);
    }
}