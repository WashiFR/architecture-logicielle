<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class GetPrestationByIdAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune prestation sélectionnée');

        $sql = Prestation::select('id', 'libelle')->where('id', $id)->get();

        if ($sql->isEmpty()) throw new HttpNotFoundException($request, 'Erreur 404 : Aucune prestation trouvée');

        $html = '';

        foreach ($sql as $prestation) {
            $html .= <<<HTML
                <h1>Préstation $prestation->id</h1>
                <p>$prestation->libelle</p>
            HTML;
        }

        $response->getBody()->write($html);
        return $response;
    }
}