<?php

namespace gift\api\core\domain;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasUuids;
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    public const CREATED = 1;

    public function prestations()
    {
        return $this->belongsToMany('gift\appli\core\domain\Prestation', 'box2presta', 'box_id', 'presta_id');
    }
}