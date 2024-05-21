<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Box extends Model
{
    use HasUuids;
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    public function prestations()
    {
        return $this->belongsToMany('gift\appli\models\Prestation', 'box2presta', 'box_id', 'presta_id');
    }
}