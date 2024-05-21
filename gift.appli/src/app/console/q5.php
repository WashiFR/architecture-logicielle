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

echo "5. Idem, en affichant en plus les prestations prévues dans la box\n\n";

foreach ($sql as $box) {
    echo "id: $box->id\n";
    echo "libellé: $box->libelle\n";
    echo "description: $box->description\n";
    echo "montant: $box->montant\n";
    echo "Prestations:\n";
    foreach ($box->prestations as $prestation) {
        echo "  --- $prestation->id ---\n";
        echo "  - $prestation->libelle\n";
        echo "  - $prestation->tarif\n";
        echo "  - $prestation->unite\n";
    }
}

?>
