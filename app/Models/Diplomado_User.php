<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplomado_User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'diplomado_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'estado',
        'f_ini',
        'f_fin',
        'diplomado_id',
        'user_id'
    ];

    /**
     * Diplomado_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Diplomado_User - puede considerar solo a 1 - Diplomado
     */
    public function diplomado()
    {
        return $this->belongsTo(Diplomado::class, 'diplomado_id');
    }
}
