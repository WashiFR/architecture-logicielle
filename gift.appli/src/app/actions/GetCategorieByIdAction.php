<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class GetCategorieByIdAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int)$args['id'];

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune catégorie sélectionnée');

        $sql = Categorie::select('id', 'description')->where('id', $id)->get();

        if ($sql->isEmpty()) throw new HttpNotFoundException($request, 'Erreur 404 : Aucune catégorie trouvée');

        $html = '';

        foreach ($sql as $categorie) {
            $html .= <<<HTML
                <h1>Catégories $categorie->id</h1>
                <p>$categorie->description</p>
                <ul>
            HTML;
            foreach ($categorie->prestations as $prestation) {
                $html .= <<<HTML
                    <li>Prestation $prestation->id</li>
                    <ul>
                        <li>$prestation->libelle</li>
                        <li>$prestation->tarif</li>
                        <li>$prestation->unite</li>
                    </ul>
                HTML;
            }
            $html .= '</ul>';
        }

        $response->getBody()->write($html);
        return $response;
    }
}