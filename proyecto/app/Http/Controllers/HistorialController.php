<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orden;
use App\Models\Historial;
use App\Models\Admin;
use App\Models\Tarea;
use App\Models\Custom;

class HistorialController extends Controller
{
    //
    public function index()
    {   
        $bg = Custom::where('id_user', 3)->get()->last();
        $historial= Historial::orderBy('id_orden', 'DESC')->get();
        $filtro = Admin::where('perfil',4)->get();
       return view('historial.index',compact('historial','bg','filtro'));  
    }

    public function create(Orden $id_orden){
        $bg = Custom::where('id_user', 3)->get()->last();
        $adminot = Admin::where('perfil', 3)->orwhere('perfil', 2)->orwhere('disponible', 2)->get();
        $idnot = [];
        foreach ($adminot as $key => $adn) {
            $idnot[$key] = $adn->id_user;
        }
        if($id_orden->id_admin != null){
        $old=$id_orden->administrador->usuario;
        $usuario = User::get()->where('tipo_usuario', 2)->whereNotIn('id',$id_orden->administrador->usuario->id)->whereNotIn('id',$idnot)->pluck('nombreCompleto', 'id');
        }else{
            $usuario = User::get()->where('tipo_usuario', 2)->whereNotIn('id',$idnot)->pluck('nombreCompleto', 'id');
            $old='';
        }
        
        return view('historial.create',compact('usuario', 'id_orden', 'old','bg'));
    }
    public function show(Historial $orden){
        $histo = Orden::where('id', $orden->id_orden)->get()->last();
        return view('historial.show',compact('histo'));
    }

    public function store(Request $request){
        try{

        $his = new Historial();
        $orden=Orden::where('id', $request->id_orden)->get()->last();
        $peso = Tarea::where('id', $orden->id_tarea)->get()->last();
        if($request->id_old==''){
        $his->anterior=0;
        }else{
        $his->anterior=$request->id_old;
        $old=Admin::where('id_user', $request->id_old)->get()->last();
        $old->tareas = $old->tareas - 1;
        $old->pesos = $old->pesos - $peso->peso;
        $old->update();
        }
        $his->actual=$request->usuario;
        $his->id_orden=$request->id_orden;
        $admin=Admin::where('id_user', $request->usuario)->get()->last();
        $orden->id_admin=$admin->id;
        $admin->tareas = $admin->tareas + 1;
        $admin->pesos = $admin->pesos + $peso->peso;
        $admin->update();

        $orden->save();
        $his->save();

            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
