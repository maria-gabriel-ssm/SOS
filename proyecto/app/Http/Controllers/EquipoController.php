<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Custom;

class EquipoController extends Controller
{
    //
    public function index()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $equipos = Equipo::orderBy('created_at', 'DESC')->get();
       return view('equipos.index',compact('equipos','bg'));   
    }
    public function inactivar(Equipo $equipo){
        $equipo->iactivo=0;
        $equipo->update();
        return redirect()->route('equipos.index');
    }
     public function activar(Equipo $equipo){
        $equipo->iactivo=1;
        $equipo->update();
        return redirect()->route('equipos.index');
    }
    public function create(Equipo $equipo)
    {  
        $bg = Custom::where('id_user', 3)->get()->last();
        return view('equipos.create',compact('equipo','bg'));
       
    }
    public function store(Request $request, Equipo $equipo){
        try{
            $up = Equipo::where('id', $equipo->id)->get()->last();
        if($up){
            $up->equipo=$request->equipo;
            $up->update();
        }else{
            $equ = new Equipo();
            $equ->equipo=$request->equipo;
            $equ->save();
        } 
        
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
