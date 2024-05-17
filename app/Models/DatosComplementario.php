<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosComplementario extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'direccion',
        'cel',
        'contacto',
        'cel_contacto',
        'estado',
        'user_id'
    ];

    /* RELACIONES */
    /**
     * Datoscomplementario - puede considerar 1 - User
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
