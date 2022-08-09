<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ingrediente';

    protected $fillable = [
        'nombre_ingrediente',
        'precio_unidad'
    ];

    public $timestamps = false;

}
