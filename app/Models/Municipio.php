<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'municipio',
        'provincia_id'
    ];

    /**
     * Municipio - puede considerar solo 1 - Provincia
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    /**
     * Municipio - puede ser considerado en 1..n - Municipio_User
     */
    public function municipios_users()
    {
        return $this->hasMany(Municipio_User::class);
    }

    /**
     * Municipio - puede ser considerado por 1..n - Unidad
     */
    public function unidads()
    {
        return $this->hasMany(Unidad::class);
    }
}
