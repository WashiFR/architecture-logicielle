<?php

namespace gift\api\app\actions;

use gift\api\app\actions\AbstractAction;
use gift\api\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetBoxbyId extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $box_id = $args['id'];
        $boxs_service = new BoxService();
        $sql = $boxs_service->getBoxById($box_id);

        $boxs = [];
        $prestations = [];
        $prestations = $boxs_service->getPrestationsByBoxId($box_id);
        foreach ($sql as $box){
            $boxs[] = [
                "Box" => [
                    "id" => $box['id'],
                    "token" => $box['token'],
                    "libelle" => $box['libelle'],
                    "description" => $box['description'],
                    "montant" => $box['montant'],
                    "kdo" => $box['kdo'],
                    "message du kdo" => $box['message_kdo'],
                    "statut" => $box['statut'],
                    "created at" => $box['created_at'],
                    "updated at" => $box['updated_at'],
                    "id du createur" => $box['createur_id'],
                    "prestations" => $prestations
                ],
            ];
        }
        $data = ['type' => 'collection', 'count' => count($boxs), 'box' => $boxs];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}