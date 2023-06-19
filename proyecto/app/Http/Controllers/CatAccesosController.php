<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storecat_accesosRequest;
use App\Http\Requests\Updatecat_accesosRequest;
use App\Models\cat_accesos;
use App\Models\Custom;
use Illuminate\Http\Request;

class CatAccesosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesos=cat_accesos::all();
        $bg = Custom::where('id_user', 3)->get()->last();
        return view('cat_accesos.index',compact('accesos','bg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        return view('cat_accesos.create', compact('bg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storecat_accesosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $acceso=new cat_accesos();
            $acceso->name=$request->nombre;
            $acceso->ruta=$request->Ruta;
            $perfile='';
            $i=1;
            for($i=1;$i<5;$i++){
                if($request->$i=='on'){
                    $perfile=$perfile.$i.',';
                }
            }
            $perfiles = rtrim($perfile, ", ");
            $acceso->tipo_usuarios_id=$perfiles;
            $acceso->save();
            
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cat_accesos  $cat_accesos
     * @return \Illuminate\Http\Response
     */
    public function show(cat_accesos $acceso)
    {
        $i=1;
        $bg = Custom::where('id_user', 3)->get()->last();
        $acc= explode(",", $acceso->tipo_usuarios_id);
        $checkperfil='';
        for($i=1;$i<5;$i++){
            if(in_array($i, $acc)){
                $checkperfil[$i]=1;
            }else{
                $checkperfil[$i]=0;
            }
        }
        return view('cat_accesos.show',compact('acceso','checkperfil','bg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cat_accesos  $cat_accesos
     * @return \Illuminate\Http\Response
     */
    public function edit(cat_accesos $cat_accesos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatecat_accesosRequest  $request
     * @param  \App\Models\cat_accesos  $cat_accesos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cat_accesos $acceso)
    {
        try{
            $acc= explode(",", $acceso->tipo_usuarios_id);
            $acceso->name=$request->name;
            $acceso->ruta=$request->acceso;
            $perfile='';
            $perfiles='';
            $i=1;
            for($i=1;$i<5;$i++){
                if($request->$i=='on'){
                    $perfile=$perfile.$i.',';
                }
            }
            $perfiles = rtrim($perfile, ", ");
            $acceso->tipo_usuarios_id=$perfiles;
            $checkindex=explode(".",$acceso->name);
            $acceso->update();
            if(array_key_exists(1, $checkindex)and $checkindex[1]!='index'){
                $busqueda=$checkindex[0].'.index';
                $this->actindex($busqueda,$perfiles);
            }
            return back()->with('ok', 'ok');
    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
    public function activar(cat_accesos $acceso){
        $acceso->iactivo=1;
        $acceso->update();
        return redirect()->route('accesos.index');
    }
    public function inactivar(cat_accesos $acceso){
        $acceso->iactivo=0;
        $acceso->update();
        return redirect()->route('accesos.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cat_accesos  $cat_accesos
     * @return \Illuminate\Http\Response
     */
    public function destroy(cat_accesos $cat_accesos)
    {
        //
    }
}
