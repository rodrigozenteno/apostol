<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'relacion'
    ];

    /* RELACIONES */
    /**
     * Relacion - puede ser considerado por 1..n - Datofamiliar
     */
    public function datofamiliars()
    {
        return $this->hasMany(Datofamiliar::class);
    }
}
