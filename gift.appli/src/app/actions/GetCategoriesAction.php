<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategoriesAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $sql = Categorie::select('id', 'libelle')->get();

        $html = <<<HTML
            <h1>Liste des Catégories</h1>
            <ul>
        HTML;

        foreach ($sql as $categorie) {
            $html .= <<<HTML
                <li><a href="../categorie/{$categorie->id}">$categorie->id : $categorie->libelle</a></li>
            HTML;
        }

        $html .= <<<HTML
            </ul>
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}