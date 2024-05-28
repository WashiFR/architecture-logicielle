<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestationByIdAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        if (empty($id)) throw new HttpBadRequestException($request, 'Erreur 400 : Aucune prestation sélectionnée');

        $sql = Prestation::select('id', 'libelle', 'description', 'unite', 'tarif', 'img')->where('id', $id)->get();

        if ($sql->isEmpty()) throw new HttpNotFoundException($request, 'Erreur 404 : Aucune prestation trouvée');

        $views = Twig::fromRequest($request);
        return $views->render($response, 'PrestationByIdView.twig', ['prestations' => $sql]);
    }
}