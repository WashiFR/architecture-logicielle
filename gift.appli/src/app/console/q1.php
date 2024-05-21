<?php

require_once '../../../src/vendor/autoload.php';

use gift\appli\models\Prestation;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('../../../src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$sql = Prestation::select('id', 'libelle', 'description', 'tarif', 'unite')
    ->get();

echo "1. Lister les prestations avec leur libellé, description, tarif et unité\n\n";

foreach ($sql as $prestation) {
    echo "id: $prestation->id\n";
    echo "libellé: $prestation->libelle\n";
    echo "description: $prestation->description\n";
    echo "tarif: $prestation->tarif\n";
    echo "unité: $prestation->unite\n";
    echo "-----\n";
}

?>