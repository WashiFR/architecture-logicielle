<?php

require_once '../../../src/vendor/autoload.php';

use gift\appli\models\Prestation;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('../../../src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$sql = Prestation::select('id', 'libelle', 'description', 'tarif', 'unite', 'cat_id')
    ->get();

echo "2. Même question que la 1. mais avec la catégorie de la préstation\n\n";

foreach ($sql as $prestation) {
    echo "id: $prestation->id\n";
    echo "libellé: $prestation->libelle\n";
    echo "description: $prestation->description\n";
    echo "tarif: $prestation->tarif\n";
    echo "unité: $prestation->unite\n";
    echo "catégorie: " . $prestation->categorie . "\n";
    echo "-----\n";
}

?>