<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCabin extends Model
{
    use HasFactory;

    protected $table = 'type_cabins';
    public $incrementing = false;
}
