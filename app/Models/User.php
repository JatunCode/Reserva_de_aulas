<?php

namespace App\Models;

use App\Models\Admin\Docente;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cargo',
        'foto',
        'ID_DOCENTE'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function adminlte_image()
    {
        return $this->foto ?: 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {

        return $this->cargo ? : 'Usuario';
    }

    public function adminlte_profile_url()
    {
        return 'profile/' . $this->username; // Asegúrate de tener un campo 'username' en tu tabla de usuarios
    }

    public function user_relacion_docente(){
        return $this->hasOne(Docente::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }
}