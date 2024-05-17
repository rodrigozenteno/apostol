<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento_User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'documento_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'f_ven',
        'archivo',
        'documento_id',
        'user_id',
        'user_verified'
    ];

    /**
     * Documento_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Documento_User - puede considerar solo a 1 - User como verificador
     */
    public function user_verified()
    {
        return $this->belongsTo(User::class, 'user_verified');
    }

    /**
     * Documento_User - puede considerar solo a 1 - Documento
     */
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'documento_id');
    }
}
