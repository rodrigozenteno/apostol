<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'marca',
        'industria_id'
    ];

    /**
     * Marca - puede considerar solo 1 - Industria
     */
    public function industria()
    {
        return $this->belongsTo(Industria::class);
    }

    /**
     * Marca - puede ser considerada por 1 .. n - Modelo
     */
    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
