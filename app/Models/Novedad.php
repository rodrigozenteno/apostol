<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'novedad'
    ];

    /* RELACIONES */
    /**
     * Novedad - puede ser considerado por 1..n - Destino_Novedad
     */
    public function destinos_novedads()
    {
        return $this->hasMany(Destino_Novedad::class);
    }
}
