<?php

namespace gift\api\app\actions;

use gift\api\app\actions\AbstractAction;
use gift\api\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestationsAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $prestations_service = new BoxService();
        $sql = $prestations_service->getPrestations();

        $prestations = [];
        foreach ($sql as $pres) {
            $prestations[] = [
                "prestation" => [
                    "id" => $pres['id'],
                    "libelle" => $pres['libelle'],
                    "description" => $pres['description'],
                    "unite" => $pres['unite'],
                    "tarif" => $pres['tarif'],
                    "img" => $pres['img'],
                    "id categorie" => $pres['cat_id']
                ],
                "links" => [
                    "self" => [
                        "href" => "/presentations/" . $pres['id'] . "/"
                    ]
                ]
            ];
        }

        $data = ['type' => 'collection', 'count' => count($prestations), 'prestations' => $prestations];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}