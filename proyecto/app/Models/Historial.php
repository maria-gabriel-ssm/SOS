<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historial';

    public function orden(){
        return $this->belongsTo(Orden::class,'id_orden','id');
    }
    public function anteriores(){
        return $this->belongsTo(User::class,'anterior','id');
    }
    public function actuales(){
        return $this->belongsTo(User::class,'actual','id');
    }

}
