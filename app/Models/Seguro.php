<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'seguro'
    ];

    /**
     * Seguro - puede ser considerado en 1..n - Carnet
     */
    public function carnets()
    {
        return $this->hasMany(Carnet::class);
    }

    /**
     * Seguro - puede ser considerado en 1..n - Datofamiliar
    */
    public function datofamiliars()
    {
        return $this->hasMany(Datofamiliar::class);
    }
}
