<?php

namespace gift\appli\app\classes;

use gift\appli\models\Box;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;

class RoutesFunctions
{
    public static function getCategories(): String
    {
        DBConnection::connect();
        $sql = Categorie::select('id', 'libelle')->get();

        $html = <<<HTML
            <h1>Liste des Catégories</h1>
            <ul>
        HTML;

        foreach ($sql as $categorie) {
            $html .= <<<HTML
                <li><a href="../categorie/{$categorie->id}">$categorie->id : $categorie->libelle</a></li>
            HTML;
        }

        $html .= <<<HTML
            </ul>
        HTML;

        return $html;
    }

    public static function getCategoriesById(int $id): String
    {
        DBConnection::connect();
        $sql = Categorie::select('id', 'description')->where('id', $id)->get();

        $html = '';

        foreach ($sql as $categorie) {
            $html .= <<<HTML
                <h1>Catégories $categorie->id</h1>
                <p>$categorie->description</p>
            HTML;
        }

        return $html;
    }

    public static function getPrestationById(int $id): String
    {
        DBConnection::connect();
        $sql = Prestation::select('id', 'libelle')->where('id', $id)->get();

        $html = '';

        foreach ($sql as $prestation) {
            $html .= <<<HTML
                <h1>Préstation $prestation->id</h1>
                <p>$prestation->libelle</p>
            HTML;
        }

        return $html;
    }

    public static function formCreateNewBox(): String
    {
        $html = <<<HTML
            <h1>Créer une nouvelle Box</h1>
            <form action="../box/create" method="post">
                <label for="libelle">Libellé</label>
                <input type="text" name="libelle" id="libelle">
                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>
                <label for="montant">Montant</label>
                <input type="number" name="montant" id="montant">
                <button type="submit">Créer</button>
            </form>
        HTML;

        return $html;
    }

    public static function createNewBox(String $libelle, String $description, int $montant): String
    {
        DBConnection::connect();

        $box = new Box;
        $box->libelle = $libelle;
        $box->description = $description;
        $box->montant = $montant;
        $box->save();

        $html = <<<HTML
            <h1>Box créée</h1>
            <p>La box $libelle a bien été créée</p>
        HTML;

        return $html;
    }
}