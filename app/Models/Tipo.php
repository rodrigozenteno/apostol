<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tipo'
    ];

    /* RELACIONES */
    /**
     * Tipo - puede ser considerado por 1..n - Unidad
     */
    public function unidads()
    {
        return $this->hasMany(Unidad::class);
    }
}