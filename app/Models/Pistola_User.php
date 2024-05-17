<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pistola_User extends Model
{
    use HasFactory;

/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pistola_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'serie',
        'dotacion',
        'cargador',
        'novedades',
        'modelo_id',
        'situacion_id',
        'user_id'
    ];

    /**
     * Pistola_User - puede considerar solo a 1 - Modelo
     */
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    /**
     * Pistola_User - puede considerar solo a 1 - Situacion
     */
    public function situacion()
    {
        return $this->belongsTo(Situacion::class, 'situacion_id');
    }

    /**
     * Pistola_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

