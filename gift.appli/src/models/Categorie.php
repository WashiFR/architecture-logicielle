<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function prestations()
    {
        return $this->hasMany('gift\appli\models\Prestation', 'cat_id');
    }

    public function box()
    {
        return $this->belongsToMany('gift\appli\models\Box', 'box2presta', 'presta_id', 'box_id');
    }
}