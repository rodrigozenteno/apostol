<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'alergia'
    ];

    /* RELACIONES */
    /**
     * Alergia - puede ser considerado por n - User
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}