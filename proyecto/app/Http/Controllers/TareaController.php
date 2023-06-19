<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Custom;

class TareaController extends Controller
{
    //
    public function index()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $tareas = Tarea::orderBy('created_at', 'DESC')->get();
       return view('tareas.index',compact('tareas','bg'));   
    }
    public function inactivar(Tarea $tarea){
        $tarea->iactivo=0;
        $tarea->update();
        return redirect()->route('tareas.index');
    }
     public function activar(Tarea $tarea){
        $tarea->iactivo=1;
        $tarea->update();
        return redirect()->route('tareas.index');
    }
    public function create(Tarea $tarea)
    {  
        $bg = Custom::where('id_user', 3)->get()->last();
        return view('tareas.create',compact('tarea','bg'));
       
    }
    public function store(Request $request, Tarea $tarea){
        try{
            $up = Tarea::where('id', $tarea->id)->get()->last();
        if($up){
            $up->tarea=$request->tarea;
            $up->peso=$request->peso;
            $up->update();
        }else{
            $tar = new Tarea();
            $tar->tarea=$request->tarea;
            $tar->peso=$request->peso;
            $tar->save();
        } 
        
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
