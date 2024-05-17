<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'provincia',
        'departamento_id'
    ];

    /**
     * Provincia - puede considerar solo 1 - Departamento
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    /**
     * Provincia - puede ser considerada por 1 .. n - Municipio
     */
    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }
}
