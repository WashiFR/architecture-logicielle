<?php

require_once '../../../src/vendor/autoload.php';

use gift\appli\models\Box;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('../../../src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$sql = Box::select('id', 'libelle', 'description', 'montant')
    ->where('id', '360bb4cc-e092-3f00-9eae-774053730cb2')
    ->get();

echo "4. Afficher la box d'ID 360bb4cc-e092-3f00-9eae-774053730cb2\n\n";

foreach ($sql as $box) {
    echo "id: $box->id\n";
    echo "libellé: $box->libelle\n";
    echo "description: $box->description\n";
    echo "montant: $box->montant\n";
}

?>
