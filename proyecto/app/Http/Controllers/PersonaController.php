<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\Custom;
use App\Models\Conferencia;
use App\Models\Area;
use App\Models\Persona;

class PersonaController extends Controller
{
    //
    public function index(){
        $users= Persona::orderBy('created_at', 'DESC')->get();
        $bg = Custom::where('id_user', 3)->get()->last();
       return view('personas.index',compact('users', 'bg'));        
    }
    public function show(Conferencia $conferencia)
    {
        $letters=[];
        $bg = Custom::where('id_user', 3)->get()->last();
        $personas = Persona::orderBy('created_at', 'DESC')->where('id_confe',$conferencia->id)->get();
        foreach ($personas as $key => $persona) {
            $letters[$key] = substr($persona->nombre, 0, 1);
        }
       return view('personas.show',compact('conferencia','letters','bg','personas'));
    }
    public function asistencia(int $conferencia){
        $resper = [];
        $personas = Persona::all();
        $bg = Custom::where('id_user', 3)->get()->last();
        $confe = Conferencia::where('id', $conferencia)->get()->last();
        $cat_area = Area::where('iactivo',1)->pluck('area', 'id');

            foreach ($personas as $key => $person) {
            if($conferencia == $person->id_confe){
                $resper[$key] = $person->email;
            }
        }
        return view('personas.asistencia', compact('cat_area','confe','resper','bg'));
    }
    public function registro(Request $request){
        try{
        $per = new Persona();
        $per->id_confe = $request->id;
        $per->nombre = $request->nombre;
        $per->apepa = $request->apepa;
        $per->apema = $request->apema;
        $per->area = $request->area;
        $per->cargo = $request->cargo;
        $per->telefono = $request->telefono;
        $per->email = $request->email;
        $per->save();
        return Redirect::to($request->link);
    }catch(\Exception $e){
           return back()->with('nook', $e->getMessage());
         }
    }

    public function tester(){
        return view('personas.tester');
    }
    public function carga(){
        return view('personas.carga');
    }
}
