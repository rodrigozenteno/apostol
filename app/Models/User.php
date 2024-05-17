<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ci',
        'comp',
        'ext',
        'papeleta',
        'prim_nombre',
        'seg_nombre',
        'prim_apellido',
        'seg_apellido',
        'f_nac',
        'sexo',
        'g_sang',
        'e_civil',
        'f_alt',
        'ant',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /* RELACIONES */
    /**
     * User - puede considerar n - Alergia
     */
    public function alergias()
    {
        return $this->belongsToMany(Alergia::class);
    }

    /**
     * User - tiene solo 1 - Carnet
     */
    public function carnet()
    {
        return $this->hasOne(Carnet::class);
    }

    /**
     * User - puede ser considerado solo en 1 - Municipio_User
     */
    public function municipio_user()
    {
        return $this->hasOne(Municipio_User::class);
    }

    /**
     * User - puede ser considerado en 1 - Datosmilitar
     */
    public function datosmilitar()
    {
        return $this->hasOne(Datosmilitar::class);
    }

    /**
     * User - puede ser considerado en 1..n - Especialidad_User
     */
    public function especialidads_users()
    {
        return $this->hasMany(Especialidad_User::class);
    }

    /**
     * User - puede ser considerado en 1..n - Diplomado_User
     */
    public function diplomados_users()
    {
        return $this->hasMany(Diplomado_User::class);
    }

    /**
     * User - puede ser considerado en 1..n - Grado_User
     */
    public function grados_users()
    {
        return $this->hasMany(Grado_User::class);
    }

    /**
     * User - puede ser considerado en 1..n - Arma_User
     */
    public function armas_users()
    {
        return $this->hasMany(Arma_User::class);
    }

    /**
     * User - puede ser considerado en 1 - Escalafon_User
     */
    public function escalafon_user()
    {
        return $this->hasOne(Escalafon_User::class);
    }

    /**
     * User - puede ser considerado en 1..n - Documento_User
     */
    public function documentos_users()
    {
        return $this->hasMany(Documento_User::class);
    }

    /**
     * User - puede ser considerado en 1..n - Profocup_User
     */
    public function profocups_users()
    {
        return $this->hasMany(Profocup_User::class);
    }

    /**
     * User - puede ser considerado en 1..n - Documento_User como verificador
     */
    public function documentos_users_verified()
    {
        return $this->hasMany(Documento_User::class,'user_verified');
    }

    /**
     * User - puede ser considerado en 1..n - Datoscomplementarios
     */
    public function datoscomplementarios()
    {
        return $this->hasMany(DatosComplementario::class);
    }

    /**
     * User - puede ser considerado en 1..n - Datofamiliar
    */
    public function datofamiliars()
    {
        return $this->hasMany(Datofamiliar::class);
    }

    /**
     * User - puede ser considerado por 1..n - Armamento_User
     */
    public function armamentos_users()
    {
        return $this->hasMany(Armamento_User::class, 'user_id');
    }

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    /**
     * User - puede ser considerado en 1..n - Destino (uno actual, el resto anteriores)
     */
    public function destinos()
    {
        return $this->hasMany(Destino::class);
    }
    // public function matbel()
    // {
    //     return $this->hasOne(Matbel::class);
    // }
   
}
