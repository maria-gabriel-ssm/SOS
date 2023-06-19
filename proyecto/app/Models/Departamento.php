<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table='departamentos';
    use HasFactory;

    public function subdirecciones()
    {
        return $this->belongsTo(Subdireccion::class,'id_sub','id');
    }
    public function conferencia(){
        return $this->hasMany(Conferencia::class);
    }
}
