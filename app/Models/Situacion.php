<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'situacion'
    ];

    /* RELACIONES */
    /**
     * Situacion - puede ser considerado por 1..n - Armamento_User
     */
    public function armamentos_users()
    {
        return $this->hasMany(Armamento_User::class, 'situacion_id');
    }
}
