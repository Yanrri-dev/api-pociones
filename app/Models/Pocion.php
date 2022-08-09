<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pocion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pocion';
    protected $table = 'pociones';

    protected $fillable = [
        'nombre_pocion'
    ];

    public $timestamps = false;

    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'pociones_ingredientes', 'id_pocion', 'id_ingrediente')->withPivot('cantidad');
    }

}
