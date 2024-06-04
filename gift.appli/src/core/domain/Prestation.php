<?php

namespace gift\appli\core\domain;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = false;

    public function categorie()
    {
        return $this->belongsTo('gift\appli\core\domain\Categorie', 'cat_id');
    }
}