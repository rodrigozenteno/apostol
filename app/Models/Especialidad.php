<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'especialidad',
        'abreviacion'
    ];

    /* RELACIONES */
    /**
     * Especialidad - puede ser considerado en 1..n - Especialidad_User
     */
    public function especialidads_users()
    {
        return $this->hasMany(Especialidad_User::class);
    }
}
