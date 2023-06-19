<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_clue extends Model
{
    use HasFactory;
    public function localidad(){
        return $this->belongsTo(localidade::class,'localidad_id','id');
    }
    public function cp(){
        return $this->belongsTo(cp::class,'cp_id','id');
    }
    public function municipios(){
        return $this->belongsTo(municipio::class,'mun_id','id');
    }
    public function getCluescompletoAttribute()
    {
       return ucfirst($this->clues) . ' ' . ucfirst($this->nom_unidad);
    }
}
