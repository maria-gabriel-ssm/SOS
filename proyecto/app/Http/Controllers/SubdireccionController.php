<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdireccion;
use App\Models\Direccion;
use App\Models\Custom;

class SubdireccionController extends Controller
{
    //
    public function index()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $subdirecciones = Subdireccion::orderBy('created_at', 'DESC')->get();
       return view('subdirecciones.index',compact('subdirecciones','bg'));   
    }
    public function inactivar(Subdireccion $subdireccion){
        $subdireccion->iactivo=0;
        $subdireccion->update();
        return redirect()->route('subdirecciones.index');
    }
     public function activar(Subdireccion $subdireccion){
        $subdireccion->iactivo=1;
        $subdireccion->update();
        return redirect()->route('subdirecciones.index');
    }
    public function details(Request $request){
        $subdirecciones = Subdireccion::where('id_dir', $request->dir)->get();
        $res_sub[0] = array(
            'id' => '',
            'value' => '',
            'text' => 'Seleccione una subdirección',
        );
        $i=1;
        foreach ($subdirecciones as $subdireccion) {
            $res_sub[$i] = array(
                'id' => $subdireccion->id,
                'value' => $subdireccion->id,
                'text' => $subdireccion->nombre,
            );
            $i++;
        }
        return response()->json($res_sub);
    }
    public function create(Subdireccion $subdireccion)
    {  
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_dir = Direccion::where('iactivo',1)->pluck('nombre', 'id');
        return view('subdirecciones.create',compact('subdireccion','bg','cat_dir'));
       
    }
    public function store(Request $request, Subdireccion $subdireccion){
        try{
            $up = Subdireccion::where('id', $subdireccion->id)->get()->last();
        if($up){
            $up->nombre=$request->nombre;
            $up->id_dir=$request->direccion;
            $up->update();
        }else{
            $dir = new Subdireccion();
            $dir->nombre=$request->nombre;
            $dir->id_dir=$request->direccion;
            $dir->save();
        } 
        
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
