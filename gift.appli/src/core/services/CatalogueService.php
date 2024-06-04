<?php

namespace gift\appli\core\services;

use gift\appli\core\domain\Box;
use gift\appli\core\domain\Categorie;
use gift\appli\core\domain\Prestation;
use gift\appli\core\services\ICatalogueService;

class CatalogueService implements ICatalogueService
{

    public function getCategories(): array
    {
        try {
            $sql = Categorie::select('id', 'libelle')->get();
        } catch (\Exception $e) {
            throw new CatalogueServiceNotFoundException('Erreur 404 : Aucune catégorie trouvée', 404);
        }
        return $sql->toArray();
    }

    public function getCategorieById(int $id): array
    {
        try {
            $sql = Categorie::select('id', 'libelle', 'description')->where('id', $id)->get();
        } catch (\Exception $e) {
            throw new CatalogueServiceNotFoundException('Erreur 404 : Aucune catégorie trouvée', 404);
        }
        $sql->load('prestations');
        return $sql->toArray();
    }

    public function createCategorie(array $data): int
    {
        $sql = new Categorie;
        $sql->libelle = $data['libelle'];
        $sql->description = $data['description'];
        $sql->save();
        return $sql->id;
    }

    public function getPrestations(): array
    {
        try {
            $sql = Prestation::select('id', 'libelle')->get();
        } catch (\Exception $e) {
            throw new CatalogueServiceNotFoundException('Erreur 404 : Aucune prestation trouvée', 404);
        }
        return $sql->toArray();
    }

    public function getPrestationById(string $id): array
    {
        try {
            $sql = Prestation::select('id', 'libelle', 'description', 'unite', 'tarif', 'cat_id', 'img')->where('id', $id)->get();
        } catch (\Exception $e) {
            throw new CatalogueServiceNotFoundException('Erreur 404 : Aucune prestation trouvée', 404);
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
            throw new CatalogueServiceNotFoundException('Erreur 404 : Aucune box trouvée', 404);
        }
        return $sql->toArray();
    }

    public function createBox(array $data): string
    {
        $sql = new Box;
        $sql->libelle = $data['libelle'];
        $sql->description = $data['description'];
        $sql->montant = $data['montant'];
        $sql->save();
        return $sql->id;
    }
}