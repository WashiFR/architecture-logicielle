<?php

namespace gift\appli\core\services\box;

use gift\appli\core\domain\Box;
use gift\appli\core\domain\Prestation;
use gift\appli\core\services\box\IBoxService;

class BoxService implements IBoxService
{

    public function getPrestations(): array
    {
        try {
            $sql = Prestation::select('id', 'libelle')
                ->orderBy('tarif', 'asc')
                ->get();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException('Erreur 404 : Aucune prestation trouvée', 404);
        }
        return $sql->toArray();
    }

    public function getPrestationById(string $id): array
    {
        try {
            $sql = Prestation::select('id', 'libelle', 'description', 'unite', 'tarif', 'cat_id', 'img')->where('id', $id)->get();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException('Erreur 404 : Aucune prestation trouvée', 404);
        }
        return $sql->toArray();
    }

    public function getPrestationByBoxId(string $box_id): array
    {
        try {
            $sql = Box::find($box_id)->prestations()
                ->orderBy('tarif', 'asc')
                ->get();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException('Erreur 404 : Aucune prestation trouvée', 404);
        }
        return $sql->toArray();
    }

    public function updatePrestation(array $data): void
    {
        $sql = Prestation::find($data['id']);

        // Verifie si l'id de la categorie est different
        if ($sql->cat_id != $data['cat_id']) {
            $this->updateIdCategorieOfPrestation($sql->id, $data['cat_id']);
        }

        $sql->libelle = $data['libelle'];
        $sql->description = $data['description'];
        $sql->tarif = $data['tarif'];
        $sql->save();
    }

    public function updateIdCategorieOfPrestation(string $presta_id, int $categ_id): void
    {
        $sql = Prestation::find($presta_id);
        $sql->cat_id = $categ_id;
        $sql->save();
    }

    public function getBoxById(string $id): array
    {
        try {
            $sql = Box::select('id', 'libelle', 'description', 'montant')->where('id', $id)->get();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException('Erreur 404 : Aucune box trouvée', 404);
        }
        return $sql->toArray();
    }

    public function getBoxFromUserId(string $user_id) : array
    {
        try {
            $sql = Box::select('id', 'libelle', 'description', 'montant')->where('createur_id', $user_id)->get();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException('Erreur 404 : Aucune box trouvée', 404);
        }
        return $sql->toArray();
    }

    public function createBox(array $data): string
    {
        $sql = new Box;

        // Verifie les données
        if ($data['libelle'] !== filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS)) {
            throw new BoxServiceBadDataException('Erreur data : libelle', 400);
        } else if ($data['description'] !== filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS)) {
            throw new BoxServiceBadDataException('Erreur data : description', 400);
        }

        if ($data['kdo'] == 1) {
            if ($data['message_kdo'] !== filter_var($data['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS)) {
                throw new BoxServiceBadDataException('Erreur data : message_kdo', 400);
            }
        }

        $sql->token = $data['token'];
        $sql->libelle = $data['libelle'];
        $sql->description = $data['description'];
        $sql->montant = 0;
        $sql->kdo = $data['kdo'];
        if ($data['kdo'] == 1) $sql->message_kdo = $data['message_kdo'];
        $sql->statut = Box::CREATED;
        $sql->created_at = date('Y-m-d H:i:s');
        $sql->updated_at = date('Y-m-d H:i:s');
        $sql->createur_id = $_SESSION['user_id'];
        $sql->save();
        return $sql->id;
    }

    public function addPrestationToBox(string $presta_id, string $box_id): void
    {
        $sql = Box::find($box_id);
        $sql->montant += Prestation::find($presta_id)->tarif;
        $sql->updated_at = date('Y-m-d H:i:s');
        $sql->prestations()->attach($presta_id);
        $sql->prestations()->updateExistingPivot($presta_id, ['quantite' => 1]);
        $sql->save();
    }

    public function removePrestationFromBox(string $presta_id, string $box_id): void
    {
        $sql = Box::find($box_id);
        $sql->montant -= Prestation::find($presta_id)->tarif;
        $sql->updated_at = date('Y-m-d H:i:s');
        $sql->prestations()->updateExistingPivot($presta_id, ['quantite' => 0]);
        $sql->prestations()->detach($presta_id);
        $sql->save();
    }
}