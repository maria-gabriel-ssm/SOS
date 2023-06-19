<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdireccion extends Model
{
    protected $table='subdirecciones';
    use HasFactory;

    public function direcciones()
    {
        return $this->belongsTo(Direccion::class,'id_dir','id');
    }
    public function departamento()
    {
        return $this->hasMany(Departamento::class);
    }
    public function conferencia(){
        return $this->hasMany(Conferencia::class);
    }
}
