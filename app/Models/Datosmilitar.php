<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datosmilitar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'estado_id',
        'escalafon_id',
        'diplomado_id',
        'grado_id',
        'arma_id',
        'profocup_id'
    ];

    /* RELACIONES */
    /**
     * Datomilitar - puede considerar solo a 1 - User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Datomilitar - puede considerar solo a 1 Estado
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    /**
     * Datomilitar - puede considerar solo a 1 Escalafon
     */
    public function escalafon()
    {
        return $this->belongsTo(Escalafon::class);
    }

    /**
     * Datomilitar - puede considerar 0..1 Diplomado
     */
    public function diplomado()
    {
        return $this->belongsTo(Diplomado::class);
    }

    /**
     * Datomilitar - puede considerar solo 1 Grado
     */
    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    /**
     * Datomilitar - puede considerar 0..1 Arma
     */
    public function arma()
    {
        return $this->belongsTo(Arma::class);
    }

    /**
     * Datomilitar - puede considerar 0..1 Profocup
     */
    public function profocup()
    {
        return $this->belongsTo(Profocup::class);
    }
}
