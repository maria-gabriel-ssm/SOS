<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\Custom;

class SedeController extends Controller
{
    //
    public function index()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $sedes = Sede::orderBy('created_at', 'DESC')->get();
       return view('sedes.index',compact('sedes','bg'));   
    }
    public function inactivar(Sede $sede){
        $sede->iactivo=0;
        $sede->update();
        return redirect()->route('sedes.index');
    }
     public function activar(Sede $sede){
        $sede->iactivo=1;
        $sede->update();
        return redirect()->route('sedes.index');
    }
    public function create(Sede $sede)
    {  
        $bg = Custom::where('id_user', 3)->get()->last();
        return view('sedes.create',compact('sede','bg'));
       
    }
    public function store(Request $request, Sede $sede){
        try{
            $up = Sede::where('id', $sede->id)->get()->last();
        if($up){
            $up->nombre=$request->nombre;
            $up->update();
        }else{
            $dir = new Sede();
            $dir->nombre=$request->nombre;
            $dir->save();
        } 
        
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
