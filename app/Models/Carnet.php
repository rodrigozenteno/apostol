<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'c_militar',
        'c_seguro',
        'seguro_id',
        'user_id'
    ];

    //RELACIONES
    /**
     * Carnet - pertenece solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Carnet - pertenece solo a 1 - Seguro
     */
    public function seguro()
    {
        return $this->belongsTo(Seguro::class);
    }
}
