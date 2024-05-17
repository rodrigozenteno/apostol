<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modelo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'modelo',
        'calibre',
        'marca_id'
    ];

    /**
     * Modelo - puede considerar solo 1 - Marca
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    /*
    * Modelo - puede ser considerado por 1..n - Armamento_User
    */
    public function armamentos_users()
    {
        return $this->hasMany(Armamento_User::class, 'modelo_id');
    }
}
