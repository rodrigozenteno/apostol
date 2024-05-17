<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplomado extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'diplomado',
        'abreviacion'
    ];

    /* RELACIONES */
    /**
     * Diplomado - puede ser considerado en 1..n - Datosmilitar
     */
    public function datosmilitars()
    {
        return $this->hasMany(Datosmilitar::class);
    }
}
