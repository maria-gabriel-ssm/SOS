<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';
    use HasFactory;

    protected $fillable = [
        'id_admin',
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class,'id_tarea','id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class,'id_area','id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function administrador()
    {
        return $this->belongsTo(Admin::class,'id_admin','id');
    }
    public function historial()
    {
        return $this->hasMany(Historial::class);
    }
    public function equipos()
    {
        return $this->belongsTo(Equipo::class,'equipo','id');
    }
}
