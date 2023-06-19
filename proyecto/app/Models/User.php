<?php

namespace App\Models;

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
    public function getnombrecompletoAttribute()
    {
       return ucfirst($this->nombre) . ' ' . ucfirst($this->apepa) . ' ' . ucfirst($this->apema);
    }
    public function cat_accesos()
    {
        return $this->belongsTo(cat_accesos::class,'iactivo','iactivo');
    }
    public function administrador(){
        return $this->hasMany(Admin::class);
    }
    public function historial(){
        return $this->hasMany(Historial::class);
    }
    public function conferencia(){
        return $this->hasMany(Conferencia::class);
    }

}
