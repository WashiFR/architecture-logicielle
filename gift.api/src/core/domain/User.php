<?php

namespace gift\api\core\domain;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuids;
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $keyType = 'string';
    const USER = 1;
    const ADMIN = 100;
}