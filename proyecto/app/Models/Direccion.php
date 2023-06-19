<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table='direcciones';
    use HasFactory;
    
    public function subdireccion()
    {
        return $this->hasMany(Subdireccion::class);
    }
    public function conferencia(){
        return $this->hasMany(Conferencia::class);
    }
}
