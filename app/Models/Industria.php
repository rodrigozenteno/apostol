<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'industria'
    ];

    /* RELACIONES */
    /**
     * Industria - puede ser considerado por 1 .. n - Marca
     */
    public function marcas()
    {
        return $this->hasMany(Marca::class);
    }
}

