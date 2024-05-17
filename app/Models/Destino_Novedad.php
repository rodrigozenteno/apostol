<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino_Novedad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destino_novedad';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'desde',
        'hasta',
        'obs',
        'destino_id',
        'novedad_id'
    ];

    /* RELACIONES */
    /**
     * Destino_Novedad - puede considerar solo 1 - Destino
     */
    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }

    /**
     * Destino_Novedad - puede considerar solo 1 - Novedad
     */
    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }
}