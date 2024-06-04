<?php

require_once '../../../src/vendor/autoload.php';

use gift\appli\core\domain\Box;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('../../../src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

echo "6. Créer une box et lui ajouter 3 prestations. L’identifiant de la box est un UUID\n\n";

// Supprime la box si elle existe
$box = Box::where('libelle', 'Box 1')->first();
if ($box) {
    $box->delete();
    echo "Box 1 supprimée\n";
}

$box = new Box;
$box->libelle = 'Box 1';
$box->description = 'Description de la box 1';
$box->montant = 100;
$box->save();

echo "Box 1 créée\n";

?>
