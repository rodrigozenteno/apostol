<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'grado',
        'abreviacion',
        'escalafon_id'
    ];

    /* RELACIONES */
    /**
     * Grado - puede considerar solo 1 - Escalafon
     */
    public function escalafon()
    {
        return $this->belongsTo(Escalafon::class);
    }

    /**
     * Grado - puede ser considerado en 1..n - Datosmilitar
     */
    public function datosmilitars()
    {
        return $this->hasMany(Datosmilitar::class);
    }
}
