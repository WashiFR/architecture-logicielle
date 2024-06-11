<?php

namespace gift\api\app\actions;

use gift\api\core\domain\Categorie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestationsByCatAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $categorie_id = $args['id'];
        $categorie = Categorie::find($categorie_id);

        if ($categorie) {
            $prestations = $categorie->prestations;
            $prestationstab = [];

            foreach ($prestations as $prestation) {
                $prestationstab[] = [
                    "prestation" => [
                        "id" => $prestation->id,
                        "libelle" => $prestation->libelle,
                        "description" => $prestation->description,
                        "unite" => $prestation->unite,
                        "tarif" => $prestation->tarif,
                        "img" => $prestation->img,
                        "id categorie" => $prestation->cat_id
                    ],
                    "links" => [
                        "self" => [
                            "href" => "/prestations/" . $prestation->id . "/"
                        ]
                    ]
                ];
            }
        }
        $data = ['type' => 'collection', 'count' => count($prestations), 'prestations' => $prestations];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
