<?php

namespace gift\appli\core\services\catalogue;

use gift\appli\core\domain\Categorie;

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

        // Verifie les données
        if ($data['libelle'] !== filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS)) {
            throw new CatalogueServiceBadDataException('Erreur data : libelle', 400);
        } else if ($data['description'] !== filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS)) {
            throw new CatalogueServiceBadDataException('Erreur data : description', 400);
        }

        $sql->libelle = $data['libelle'];
        $sql->description = $data['description'];
        $sql->save();
        return $sql->id;
    }
}