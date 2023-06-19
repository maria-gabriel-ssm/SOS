<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Orden;
use App\Models\Area;
use App\Models\Tarea;
use App\Models\Equipo;
use App\Models\Seguimiento;
use App\Models\Evaluaciones;
use App\Models\Custom;
use App\Models\User;
use App\Models\Admin;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        $comentarios = Seguimiento::all();
        $evaluaciones = Evaluaciones::all();
        $rescom = [];
        $reseva = 2;
        $fechas = [];
        $bg = Custom::where('id_user', 3)->get()->last();
        $type = Admin::where('id_user', Auth::user()->id)->get()->last();
        $filtro = Admin::where('perfil',4)->orWhere('perfil',5)->get();
        $cat_area = Area::where('iactivo',1)->pluck('area', 'id');
        $cat_tarea = Tarea::where('iactivo',1)->pluck('tarea', 'id');
        $cat_equipo = Equipo::where('iactivo',1)->pluck('equipo', 'id');
        $ordenes= Orden::orderBy('created_at', 'DESC')->where('estado',1)->get();
        $ordenes_admin= Orden::orderBy('created_at', 'DESC')->where('id_admin', Auth::user()->id)->where('estado',1)->get();
        $ordenes_user= Orden::where('id_user',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $hoy = Carbon::now();
        foreach ($ordenes as $key => $orden) {
            $datte=Carbon::parse($orden->created_at->toDateString());
            if($orden->created_at->dayOfWeek == Carbon::FRIDAY){
                $fechas[$key]=$datte->diffInDays($hoy)-2;
            }elseif($orden->created_at->dayOfWeek == Carbon::THURSDAY){
                $fechas[$key]=$datte->diffInDays($hoy)-2;
            }else{
                $fechas[$key]=$datte->diffInDays($hoy);
            }
            foreach ($comentarios as $comen) {
            if($orden->id == $comen->id_orden){
                $rescom[$key] = 1;
            }
            }
            }
            foreach ($ordenes_user as $key => $ordens) {
                foreach ($evaluaciones as $eva) {
            if($ordens->id == $eva->id_orden){
                $reseva = 1;
            }else{
                $reseva = 2;
            }
            }
            }
        $user=User::find(Auth::user()->id);
       return view('home',compact('ordenes', 'cat_area', 'cat_tarea', 'cat_equipo', 'user', 'fechas', 'type', 'bg', 'filtro','rescom','reseva'));
    }
    public function delete(Orden $orden){
        $bg = Custom::where('id_user', 3)->get()->last();
        $comentario = Seguimiento::where('id_orden', $orden->id)->get()->last();
        return view('ordenes.finalize',compact('orden','bg','comentario'));
    }
    public function finish(Orden $orden){
        try{
        $admin = Admin::where('id', $orden->id_admin)->get()->last();
        $peso = Tarea::where('id', $orden->id_tarea)->get()->last();
        $admin->tareas = $admin->tareas - 1;
        $admin->pesos = $admin->pesos - $peso->peso;
        $admin->total = $admin->total + 1;
        $orden->estado=2;
        $orden->update();
        $admin->update();

        return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
    public function store(Request $request){
        try{
        $ord = new Orden();
        $ord->id_area=$request->area;
        $ord->id_tarea=$request->tarea;
        $ord->telefono= $request->telefono;
        $ord->descripcion= $request->descripcion;
        $ord->equipo=$request->equipo;
        $ord->id_user=Auth::user()->id;
        $ord->name= $request->nombre;

        $usuariosDisponibles = Admin::where('disponible', 1)->get();
        $ultimoAsignado = Admin::where('estatus', 1)->first();

        // Si no hay ningún usuario con estatus 1, asignar la tarea al primero de la lista
        if (!$ultimoAsignado) {
            $primerUsuario = $usuariosDisponibles->first();
            $primerUsuario->estatus = 1;
            $primerUsuario->save();
            $ord->id_admin=$primerUsuario->id;
        }

        // Encontrar el siguiente usuario en la lista para asignarle la tarea
        $indiceUltimoAsignado = $usuariosDisponibles->search(function ($usuario) use ($ultimoAsignado) {
            return $usuario->id == $ultimoAsignado->id;
        });
        $siguienteIndice = ($indiceUltimoAsignado + 1) % count($usuariosDisponibles);
        $siguienteUsuario = $usuariosDisponibles[$siguienteIndice];

        // Asignar la tarea al siguiente usuario y actualizar el estatus del último asignado
        $ultimoAsignado->estatus = 0;
        $siguienteUsuario->estatus = 1;
        $siguienteUsuario->save();
        $ultimoAsignado->save();
        $ord->id_admin=$siguienteUsuario->id;
        $ord->save();


            return redirect()->route('home')->with('ok', 'ok');
    }catch(\Exception $e){
            return redirect()->route('home')->with('nook', 'nook');
         }
    }

    public function expediente()
    {  
        $evaluaciones = Evaluaciones::all();
        $reseva = [];
        $fechas = [];
        $bg = Custom::where('id_user', 3)->get()->last();
        $type = Admin::where('id_user', Auth::user()->id)->get()->last();
        $filtro = Admin::where('perfil',4)->orWhere('perfil',5)->get();
        $cat_area = Area::where('iactivo',1)->pluck('area', 'id');
        $cat_tarea = Tarea::where('iactivo',1)->pluck('tarea', 'id');
        $cat_equipo = Equipo::where('iactivo',1)->pluck('equipo', 'id');
        $ordenes= Orden::orderBy('created_at', 'DESC')->where('estado',2)->get();
        $ordenes_admin= Orden::orderBy('created_at', 'DESC')->where('id_admin', Auth::user()->id)->where('estado',2)->get();
        $hoy = Carbon::now();
        foreach ($ordenes as $key => $orden) {
            $datte=Carbon::parse($orden->created_at->toDateString());
            if($orden->created_at->dayOfWeek == Carbon::FRIDAY){
                $fechas[$key]=$datte->diffInDays($hoy)-2;
            }elseif($orden->created_at->dayOfWeek == Carbon::THURSDAY){
                $fechas[$key]=$datte->diffInDays($hoy)-2;
            }else{
                $fechas[$key]=$datte->diffInDays($hoy);
            }
            foreach ($evaluaciones as $eva) {
            if($orden->id == $eva->id_orden){
                $reseva[$key] = 1;
            }
            }
            }
        $user=User::find(Auth::user()->id);
       return view('ordenes/expediente',compact('ordenes', 'cat_area', 'cat_tarea', 'cat_equipo', 'user', 'fechas', 'type', 'bg', 'filtro','reseva'));
    }
    
}
