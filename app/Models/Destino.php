<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'f_ini',
        'f_fin',
        'user_id',
        'unidad_id'
    ];

    /* RELACIONES */
    /**
     * Destino - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Destino - puede considerar solo a 1 - Unidad
     */
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    /**
     * Destino - puede ser considerado por 1..n - Destino_Novedad
     */
    public function destinos_novedads()
    {
        return $this->hasMany(Destino_Novedad::class);
    }
}
