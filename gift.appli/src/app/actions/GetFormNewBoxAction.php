<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetFormNewBoxAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $html = <<<HTML
            <h1>Créer une nouvelle Box</h1>
            <form action="../box/create" method="post">
                <label for="libelle">Libellé</label>
                <input type="text" name="libelle" id="libelle">
                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>
                <label for="montant">Montant</label>
                <input type="number" name="montant" id="montant">
                <button type="submit">Créer</button>
            </form>
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}