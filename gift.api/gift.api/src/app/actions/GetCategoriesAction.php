<?php

namespace gift\api\app\actions;

use gift\api\app\actions\AbstractAction;
use gift\api\core\domain\Categorie;
use gift\api\core\services\catalogue\CatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategoriesAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $categories_service = new CatalogueService();
        $sql = $categories_service->getCategories();

        $categories = [];
        foreach ($sql as $cat) {
            $categories[] = [
                "categorie" => [
                    "id" => $cat['id'],
                    "libelle" => $cat['libelle'],
                    "description" => $cat['description']
                ],
                "links" => [
                    "self" => [
                        "href" => "/categories/" . $cat['id'] . "/"
                    ]
                ]
            ];
        }

        $data = ['type' => 'collection', 'count' => count($categories), 'categories' => $categories];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}