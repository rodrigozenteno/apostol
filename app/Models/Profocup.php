<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profocup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'profocup'
    ];

    /* RELACIONES */
    /**
     * Profocup - puede ser considerado en 1..n - Profocup_User
     */
    public function profocups_users()
    {
        return $this->hasMany(Profocup_User::class, 'profocup_id');
    }
}
