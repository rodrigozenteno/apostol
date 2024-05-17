<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estado_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'estado',
        'f_ini',
        'f_fin',
        'estado_id',
        'user_id'
    ];

    /**
     * Estado_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Estado_User - puede considerar solo a 1 - Estado
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
