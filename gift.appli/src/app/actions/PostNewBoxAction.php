<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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

        $html = <<<HTML
            <h1>Box créée</h1>
            <p>La box $libelle a bien été créée</p>
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}