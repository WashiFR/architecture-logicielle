<?php

namespace gift\api\app\actions;

use gift\api\core\domain\Categorie;
use gift\api\core\services\catalogue\CatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestationsByCatAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $categorie_id = $args['id'];
        $categories_service = new CatalogueService();
        $categorie = $categories_service->getCategorieById($categorie_id);

        if ($categorie) {

            $prestationstab = [];

            foreach ($categorie as $cat) {
                foreach ($cat['prestations'] as $prestation){
                    $prestationstab[] = [
                        "prestation" => [
                            "id" => $prestation['id'],
                            "libelle" => $prestation['libelle'],
                            "description" => $prestation['description'],
                            "unite" => $prestation['unite'],
                            "tarif" => $prestation['tarif'],
                            "img" => $prestation['img'],
                            "id categorie" => $prestation['cat_id']
                        ],
                        "links" => [
                            "self" => [
                                "href" => "/prestations/" . $prestation['id'] . "/"
                            ]
                        ]
                    ];
                }

            }
        }
        $data = ['type' => 'collection', 'count' => count($prestationstab), 'prestations' => $prestationstab];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
