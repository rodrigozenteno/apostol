<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escalafon_User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'escalafon_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'estado',
        'f_ini',
        'f_fin',
        'escalafon_id',
        'user_id'
    ];

    /**
     * Escalafon_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Escalafon_User - puede considerar solo a 1 - Escalafon
     */
    public function escalafon()
    {
        return $this->belongsTo(Escalafon::class);
    }
}
