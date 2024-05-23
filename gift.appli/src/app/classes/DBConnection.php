<?php

namespace gift\appli\app\classes;

use Illuminate\Database\Capsule\Manager as DB;

class DBConnection
{
    public static function connect() : void
    {
        $db = new DB();
        $db->addConnection(parse_ini_file('../src/conf/conf.ini'));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}