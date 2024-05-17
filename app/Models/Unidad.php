<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'unidad',
        'abrev',
        'municipio_id',
        'unidad_id',
        'ubicacion_id',
        'tipo_id'
    ];

    /**
     * Unidad - puede considerar solo a 1 - Municipio
     */
    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    /**
     * Unidad - puede considerar solo a 1 - Ubicacion
     */
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    /**
     * Unidad - puede considerar solo a 1 - Tipo
     */
    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    /**
     * Unidad - puede considerar solo a 1 - Unidad //Unidad superior
     */
    public function superior()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    /**
     * Unidad - puede ser considerada por 1..n - Unidad  //Unidades subalternas
     */
    public function subalternas()
    {
        return $this->hasMany(Unidad::class, 'unidad_id');
    }

    /**
     * Unidad - puede ser considerada por 1..n - Destino
     */
    public function destinos()
    {
        return $this->hasMany(Destino::class);
    }
}

