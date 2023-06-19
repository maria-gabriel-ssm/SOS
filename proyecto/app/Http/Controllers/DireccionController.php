<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\Custom;

class DireccionController extends Controller
{
    //
    public function index()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $direcciones = Direccion::orderBy('created_at', 'DESC')->get();
       return view('direcciones.index',compact('direcciones','bg'));   
    }
    public function inactivar(Direccion $direccion){
        $direccion->iactivo=0;
        $direccion->update();
        return redirect()->route('direcciones.index');
    }
     public function activar(Direccion $direccion){
        $direccion->iactivo=1;
        $direccion->update();
        return redirect()->route('direcciones.index');
    }
    public function create(Direccion $direccion)
    {  
        $bg = Custom::where('id_user', 3)->get()->last();
        return view('direcciones.create',compact('direccion','bg'));
       
    }
    public function store(Request $request, Direccion $direccion){
        try{
            $up = Direccion::where('id', $direccion->id)->get()->last();
        if($up){
            $up->nombre=$request->nombre;
            $up->update();
        }else{
            $dir = new Direccion();
            $dir->nombre=$request->nombre;
            $dir->save();
        } 
        
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
