<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'departamento'
    ];

    /**
     * Departamento - puede ser considerado por 1 .. n - Provincia
     */
    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }
}
