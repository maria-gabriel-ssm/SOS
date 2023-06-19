<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conferencia extends Model
{
    use HasFactory;
    public function usuario(){
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function sedes(){
        return $this->belongsTo(Sede::class,'sede','id');
    }
    public function direcciones(){
        return $this->belongsTo(Direccion::class,'id_dir','id');
    }
    public function subdirecciones(){
        return $this->belongsTo(Subdireccion::class,'id_sub','id');
    }
    public function departamentos(){
        return $this->belongsTo(Departamento::class,'id_dep','id');
    }
}
