<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categorie()
    {
        return $this->belongsTo('gift\appli\models\Categorie', 'cat_id');
    }
}