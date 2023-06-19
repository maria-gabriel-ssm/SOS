<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Evaluaciones;
use App\Models\Custom;

class EvaluacionesController extends Controller
{
    //
    public function index()
    {
        $evaluaciones = Evaluaciones::all();
        return view('evaluaciones.index',compact('evaluaciones')); 
    }
    public function create(Orden $evaluacion)
    {
       $bg = Custom::where('id_user', 3)->get()->last();
       $calificacion = Evaluaciones::where('id_orden', $evaluacion->id)->get()->last();
       return view('evaluaciones.create',compact('calificacion', 'evaluacion','bg'));
    }
    public function show(Orden $evaluacion)
    {
       $bg = Custom::where('id_user', 3)->get()->last();
       $calificacion = Evaluaciones::where('id_orden', $evaluacion->id)->get()->last();
       $reporte = Orden::where('id', $evaluacion->id)->get()->last();
       return view('evaluaciones.show',compact('calificacion','reporte' , 'evaluacion','bg'));
    }
    public function store(Request $request, Orden $evaluacion){

        try{
        $orden = Orden::where('id', $evaluacion->id)->get()->last();
        if($request->comentario == null){
            $orden->reporte = $request->reporte;
            $orden->update();
        }else{
        $eva = new Evaluaciones();
            if($request->rating5){
                $eva->evaluacion = 5;
            }else if($request->rating4){
                $eva->evaluacion = 4;
            }else if($request->rating3){
                $eva->evaluacion = 3;
            }else if($request->rating2){
                $eva->evaluacion = 2;
            }else if($request->rating1){
                $eva->evaluacion = 1;
            }
            $eva->comentario = $request->comentario;
            $eva->id_orden = $evaluacion->id;
            $eva->save(); 
        }
        return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
