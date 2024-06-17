<?php

namespace gift\api\core\domain;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function prestations()
    {
        return $this->hasMany('gift\api\core\domain\Prestation', 'cat_id');
    }

    public function box()
    {
        return $this->belongsToMany('gift\api\core\domain\Box', 'box2presta', 'presta_id', 'box_id');
    }
}