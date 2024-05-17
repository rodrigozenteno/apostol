<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio_User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'municipio_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'municipio_id',
        'user_id'
    ];

    /**
     * Municipio_User - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Municipio_User - puede considerar solo a 1 - Municipio
     */
    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
