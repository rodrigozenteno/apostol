<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matbel extends Model
{
    use HasFactory;
    protected $table = 'matbels';
    protected $fillable = [
        'user_id',
        'grado_id',
        'marca_id',
        'estado',
        'profile_image',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id',);
    }
    public function grado()
    {
        return $this->hasOne(Grado::class, 'id', 'grado_id',);
    }
    public function marca()
    {
        return $this->hasOne(Marca::class, 'id', 'marca_id',);
    }
    public function tipo_armamento()
    {
        return $this->hasOne(Tipo_armamento::class, 'id', 'tipo_armamento_id',);
    }
    public function situacion()
    {
        return $this->hasOne(Situacion::class, 'id', 'situacion_id',);
    }
}
