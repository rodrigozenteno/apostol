<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escalafon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'escalafon'
    ];

    /**
     * Escalafon - puede ser considerado por 1 .. n - Grado
     */
    public function grados()
    {
        return $this->hasMany(Grado::class);
    }

    /**
     * Escalafon - puede ser considerado en 1..n - Datosmilitar
     */
    public function datosmilitars()
    {
        return $this->hasMany(Datosmilitar::class);
    }
}
