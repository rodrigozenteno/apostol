<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datofamiliar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'prim_apellido',
        'seg_apellido',
        'nombres',
        'c_seguro',
        'relacion_id',
        'seguro_id',
        'user_id'
    ];

    /* RELACIONES */
    /**
     * Datofamiliar - puede considerar solo a 1 - Seguro
     */
    public function seguro()
    {
        return $this->belongsTo(Seguro::class);
    }

    /**
     * Datofamiliar - puede considerar solo a 1 - Relacion
     */
    public function relacion()
    {
        return $this->belongsTo(Relacion::class);
    }

    /**
     * Datofamiliar - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}