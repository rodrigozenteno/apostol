<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'documento'
    ];

    /* RELACIONES */
    /**
     * Documento - puede ser considerado en 1..n - Documento_User
     */
    public function documentos_users()
    {
        return $this->hasMany(Documento_User::class, 'documento_id');
    }
}
