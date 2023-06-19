<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Subdireccion;
use App\Models\Custom;

class DepartamentoController extends Controller
{
    //
    public function index()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $departamentos = Departamento::orderBy('created_at', 'DESC')->get();
       return view('departamentos.index',compact('departamentos','bg'));   
    }
    public function inactivar(Departamento $departamento){
        $departamento->iactivo=0;
        $departamento->update();
        return redirect()->route('departamentos.index');
    }
     public function activar(Departamento $departamento){
        $departamento->iactivo=1;
        $departamento->update();
        return redirect()->route('departamentos.index');
    }
    public function details(Request $request){
        $departamentos = Departamento::where('id_sub', $request->sub)->get();
        $res_dep[0] = array(
            'id' => '',
            'value' => '',
            'text' => 'Seleccione un departamento',
        );
        $i=1;
        foreach ($departamentos as $departamento) {
            $res_dep[$i] = array(
                'id' => $departamento->id,
                'value' => $departamento->id,
                'text' => $departamento->nombre,
            );
            $i++;
        }
        return response()->json($res_dep);
    }
    public function create(Departamento $departamento)
    {  
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_sub = Subdireccion::where('iactivo',1)->pluck('nombre', 'id');
        return view('departamentos.create',compact('departamento','bg','cat_sub'));
       
    }
    public function store(Request $request, Departamento $departamento){
        try{
            $up = Departamento::where('id', $departamento->id)->get()->last();
        if($up){
            $up->nombre=$request->nombre;
            $up->id_sub=$request->subdireccion;
            $up->update();
        }else{
            $dir = new Departamento();
            $dir->nombre=$request->nombre;
            $dir->id_sub=$request->subdireccion;
            $dir->save();
        } 
        
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
