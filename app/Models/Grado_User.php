<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado_User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grado_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'estado',
        'f_ini',
        'f_fin',
        'grado_id',
        'user_id'
    ];

    /**
     * Grado_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Grado_User - puede considerar solo a 1 - Grado
     */
    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }
}
