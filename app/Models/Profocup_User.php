<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profocup_User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profocup_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'estado',
        'f_ini',
        'f_fin',
        'profocup_id',
        'user_id'
    ];

    /**
     * Profocup_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Profocup - puede ser considerado en 1..n - Datosmilitar
     */
    public function datosmilitars()
    {
        return $this->hasMany(Datosmilitar::class);
    }
}
