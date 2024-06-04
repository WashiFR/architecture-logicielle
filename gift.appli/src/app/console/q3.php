<?php

require_once '../../../src/vendor/autoload.php';

use gift\appli\core\domain\Categorie;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('../../../src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$sql = Categorie::select('id', 'libelle')
    ->where('id', 3)
    ->get();

echo "3. Afficher la catégorie 3 et la liste des préstations de cette catégorie\n\n";

foreach ($sql as $categorie) {
    echo "Catégorie: $categorie->libelle\n";
    echo "Préstations:\n";
    foreach ($categorie->prestations as $prestation) {
        echo "  --- $prestation->id ---\n";
        echo "  - $prestation->libelle\n";
        echo "  - $prestation->tarif\n";
        echo "  - $prestation->unite\n";
    }
}

?>
