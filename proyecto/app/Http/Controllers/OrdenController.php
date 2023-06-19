<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Area;
use App\Models\User;
use App\Models\Admin;
use App\Models\Tarea;
use App\Models\Equipo;
use App\Models\Seguimiento;
use App\Models\Evaluaciones;
use App\Models\Custom;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrdenController extends Controller
{
    //
    public function index()
    {
        $comentarios = Seguimiento::all();
        $evaluaciones = Evaluaciones::all();
        $rescom = [];
        $reseva = [];
        $fechas = [];
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_area = Area::where('iactivo',1)->pluck('area', 'id');
        $cat_tarea = Tarea::where('iactivo',1)->pluck('tarea', 'id');
        $ordenes= Orden::where('id_user',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $hoy = Carbon::now();
        foreach ($ordenes as $key => $orden) {
            $datte=Carbon::parse($orden->created_at->toDateString());
            $fechas[$key]=$datte->diffInDays($hoy);
            foreach ($comentarios as $comen) {
                if($orden->id == $comen->id_orden){
                    $rescom[$key] = 1;
                }
            }
            foreach ($evaluaciones as $eva) {
                if($orden->id == $eva->id_orden){
                    $reseva[$key] = 1;
                }
            }
        }
        return view('ordenes.index',compact('ordenes', 'cat_area', 'cat_tarea', 'fechas', 'bg','rescom','reseva'));   
    }
    public function create()
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_area = Area::where('iactivo',1)->pluck('area', 'id');
        $cat_tarea = Tarea::where('iactivo',1)->pluck('tarea', 'id');
        $cat_user = User::all()->pluck('username', 'id');
        $cat_equipo = Equipo::where('iactivo',1)->pluck('equipo', 'id');
        $ordenes= Orden::all();
        return view('ordenes.create',compact('ordenes', 'cat_area', 'cat_tarea', 'cat_user', 'cat_equipo','bg'));
    }
    public function show(Orden $orden)
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_area = Area::all()->pluck('area', 'id');
        $cat_tarea = Tarea::where('iactivo',1)->pluck('tarea', 'id');
        $cat_user = User::where('iactivo',1)->pluck('username', 'id');
        $cat_equipo = Equipo::where('iactivo',1)->pluck('equipo', 'id');
        return view('ordenes.show',compact('orden', 'cat_area', 'cat_tarea', 'cat_user', 'cat_equipo','bg'));
    }
    public function details(Request $request){
      $orden = Orden::where('id',$request->orden)->get()->last();
      $area = Area::where('id', $orden->id_area)->get()->last();
      $equipo['nombre'] = Equipo::where('id', $orden->equipo)->get()->last();

      $nueva = $orden->toArray()+$area->toArray()+$equipo;

      return response()->json($nueva);
  }
  public function reload(){
      $orden = Orden::all();

      return response()->json($orden);
  }
  public function store(Request $request, Orden $orden){
    try{
        $up = Orden::where('id', $orden->id)->get()->last();
        if($up){
            $up->id_area=$request->area;
            $up->id_tarea=$request->tarea;
            $up->telefono= $request->telefono;
            $up->descripcion= $request->descripcion;
            $up->equipo=$request->equipo;
            $up->id_user=$request->usuario;
            $up->name=$request->name;
            $up->update();
        }else{
            $ord = new Orden();
            $id_admin = Admin::where('id_user', Auth::user()->id)->get()->last();
            $ord->id_admin=$id_admin->id;
            $ord->id_area=$request->area;
            $ord->id_tarea=$request->tarea;
            $ord->telefono= $request->telefono;
            $ord->descripcion= $request->descripcion;
            $ord->equipo=$request->equipo;
            $ord->id_user=$request->usuario;
            $ord->name=$request->name;

            $peso = Tarea::where('id', $request->tarea)->get()->last();
            $id_admin->tareas = $id_admin->tareas + 1;
            $id_admin->pesos = $id_admin->pesos + $peso->peso;
            $id_admin->update();

            $ord->save();
        } 
        
        return back()->with('ok', 'ok');
    }catch(\Exception $e){
        return back()->with('nook', $e->getMessage());
    }
}

public function reporte()
{  
    $cat_tarea = Tarea::where('iactivo', 1)->pluck('tarea', 'id');
    $cat_area = Area::where('iactivo',1)->pluck('area', 'id');
    $cat_equipo = Equipo::where('iactivo',1)->pluck('equipo', 'id');
    $cat_tecnico = Admin::where('perfil',4)->orWhere('perfil',5)->pluck('username', 'id');

    $bg = Custom::where('id_user', 3)->get()->last();
    $hoy = Carbon::now();
    $danger = 0; $warning = 0; $success = 0; $commen = 0; 
    $tecnico = []; $tecnicosem = []; $areas = [];
    $cat_segs = Seguimiento::all()->unique('id_orden');
    $cat_areas = Area::where('iactivo', 1)->get();
    $pendientes = Orden::where('estado',1)->get();
    $finalizadas = Orden::where('estado',2)->get();
    $semanales = Orden::where('estado',2)->whereDate('created_at', '>=', Carbon::now()->add(-6, 'day'))->get();
    $normales = User::where('tipo_usuario',1)->get();
    $nuevos = User::whereDate('created_at', '>=', Carbon::now()->add(-6, 'day'))->get();
    $tecnicos = Admin::where('perfil',4)->orWhere('perfil',3)->orWhere('perfil',5)->get();
    $masters = Admin::where('perfil',2)->get();
    $admins = Admin::where('perfil', 4)->orWhere('perfil',5)->get();
    foreach ($pendientes as $key => $pen) {
        $datte=Carbon::parse($pen->created_at->toDateString());
        if($pen->created_at->dayOfWeek == Carbon::FRIDAY){
            $fechas[$key]=$datte->diffInDays($hoy)-2;
        }elseif($pen->created_at->dayOfWeek == Carbon::THURSDAY){
            $fechas[$key]=$datte->diffInDays($hoy)-2;
        }else{
            $fechas[$key]=$datte->diffInDays($hoy);
        }
        if($fechas[$key]==2){
            $warning = $warning + 1;
        }elseif($fechas[$key]>2) {
            $danger = $danger + 1;
        }else{
            $success = $success + 1;
        }

        foreach ($cat_segs as $key => $segs){
            if($segs->id_orden == $pen->id){
                $commen = $commen + 1;
            }
        }
    }

    foreach ($admins as $key => $admin) {
        $tecnico = $tecnico + [
            $admin->username => 0,
        ];
        $tecnicosem = $tecnicosem + [
            "ID ".$admin->id => 0,
        ];
    }

    $semanal = ['lunes' => 0,'martes' => 0,'miercoles' => 0,'jueves' => 0,'viernes' => 0];
    $nuevosem = ['lunes' => 0,'martes' => 0,'miercoles' => 0,'jueves' => 0,'viernes' => 0];
    $semanalday = ['1' => 'Lun','2' => 'Mar','3' => 'Mie','4' => 'Jue','5' => 'Vie'];
    $nuevosday = ['1' => 'Lun','2' => 'Mar','3' => 'Mie','4' => 'Jue','5' => 'Vie'];

    foreach ($semanales as $key => $sem) {
        if($sem->created_at->dayOfWeek == Carbon::MONDAY){
            $semanal['lunes'] = $semanal['lunes'] + 1;
            $semanalday['1'] = "Lun ".$sem->created_at->format('d');
        }elseif($sem->created_at->dayOfWeek == Carbon::TUESDAY){
            $semanal['martes'] = $semanal['martes'] + 1;
            $semanalday['2'] = "Mar ".$sem->created_at->format('d');
        }elseif($sem->created_at->dayOfWeek == Carbon::WEDNESDAY){
            $semanal['miercoles'] = $semanal['miercoles'] + 1;
            $semanalday['3'] = "Mie ".$sem->created_at->format('d');
        }elseif($sem->created_at->dayOfWeek == Carbon::THURSDAY){
            $semanal['jueves'] = $semanal['jueves'] + 1;
            $semanalday['4'] = "Jue ".$sem->created_at->format('d');
        }elseif($sem->created_at->dayOfWeek == Carbon::FRIDAY){
            $semanal['viernes'] = $semanal['viernes'] + 1;
            $semanalday['5'] = "Vie ".$sem->created_at->format('d');
        }

    }

    foreach ($nuevos as $key => $nue) {
        if($nue->created_at->dayOfWeek == Carbon::MONDAY){
            $nuevosem['lunes'] = $nuevosem['lunes'] + 1;
            $nuevosday['1'] = "Lun ".$nue->created_at->format('d');
        }elseif($nue->created_at->dayOfWeek == Carbon::TUESDAY){
            $nuevosem['martes'] = $nuevosem['martes'] + 1;
            $nuevosday['2'] = "Mar ".$nue->created_at->format('d');
        }elseif($nue->created_at->dayOfWeek == Carbon::WEDNESDAY){
            $nuevosem['miercoles'] = $nuevosem['miercoles'] + 1;
            $nuevosday['3'] = "Mie ".$nue->created_at->format('d');
        }elseif($nue->created_at->dayOfWeek == Carbon::THURSDAY){
            $nuevosem['jueves'] = $nuevosem['jueves'] + 1;
            $nuevosday['4'] = "Jue ".$nue->created_at->format('d');
        }elseif($nue->created_at->dayOfWeek == Carbon::FRIDAY){
            $nuevosem['viernes'] = $nuevosem['viernes'] + 1;
            $nuevosday['5'] = "Vie ".$nue->created_at->format('d');
        }

    }

    foreach ($semanales as $finse) {
        foreach ($admins as $key => $admin) {
            if($admin->id == $finse->id_admin){
                $tecnicosem["ID ".$admin->id] = $tecnicosem["ID ".$admin->id] + 1;
            }
        }
    }

    foreach ($finalizadas as $fin) {
        foreach ($admins as $key => $admin) {
            if($admin->id == $fin->id_admin){
                $tecnico[$admin->username] = $tecnico[$admin->username] + 1;
            }
        }
        foreach ($cat_areas as $key => $area) {
            if($area->id == $fin->id_area){
                $areas = $areas + [
                    $area->area => 0,
                ];
                $areas[$area->area] = $areas[$area->area] + 1;
            }
        }
    }

    $prioridad = [
        'success' => $success,
        'warning' => $warning,
        'danger' => $danger,
        'commen' => $commen,
    ];

    $total = [
        'pendientes' => count($pendientes),
        'finalizadas' => count($finalizadas),
        'areas' => count($cat_areas),
        'sustentadas' => count($areas),
        'semanales' => count($semanales),
        'tecnicos' => count($tecnicosem),
    ];

    $usuarios = [
        'normales' => count($normales),
        'nuevos' => count($nuevos),
        'tecnicos' => count($tecnicos),
        'administradores' => count($masters),
    ];

    return view('reportes.ordenes',compact('total', 'usuarios', 'prioridad', 'tecnico', 'tecnicosem','semanal', 'semanalday', 'nuevosem', 'nuevosday', 'bg','cat_tarea', 'cat_area', 'cat_equipo', 'cat_tecnico'));
}

public function reporte_tec(Request $request)
{   
    $finalizadas = DB::table('ordenes')->where('estado', '=', 2);
    $cat_tareas = Tarea::where('iactivo', 1)->get();
    $cat_areas = Area::where('iactivo', 1)->get();

    if($request->fchIni != 0) {
        $from = Carbon::parse($request->fchIni)->format('Y-m-d');
        $to = Carbon::parse($request->fchFin)->format('Y-m-d');
        $finalizadas = $finalizadas->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
    }
    if($request->tarea != 0){
        $finalizadas = $finalizadas->where('id_tarea', $request->tarea);
    }
    if($request->area != 0){
        $finalizadas = $finalizadas->where('id_area', $request->area);
    }
    if($request->equipo != 0){
        $finalizadas = $finalizadas->where('equipo', $request->equipo);
    }
    if($request->tecnico != 0){
        $finalizadas = $finalizadas->where('id_admin', $request->tecnico);
    }

    $users = $finalizadas;
    $finalizadas = $finalizadas->get();

    $tecnicos = []; $evaluaciones = []; $tareas = []; $areas = []; $estrellas = []; $usuarios = [];
    $admins = Admin::where('perfil', 4)->orWhere('perfil',5)->get(); $cat_evaluas = Evaluaciones::all();

    foreach ($admins as $key => $admin) {
        $tecnicos = $tecnicos + [
            $admin->username => 0,
        ];
        $evaluaciones = $evaluaciones + [
            $admin->username => 0,
        ];
        $estrellas = $estrellas + [
            $admin->username => 0,
        ];
    }
    
    foreach ($cat_tareas as $key => $tarea) {
        $tareas = $tareas + [
            $tarea->tarea => 0,
        ];
    }

    foreach ($finalizadas as $fin) {
        foreach ($admins as $key => $admin) {
            if($admin->id == $fin->id_admin){
                $tecnicos[$admin->username] = $tecnicos[$admin->username] + 1;
                foreach ($cat_evaluas as $key => $evaluacion) {
                    if($evaluacion->id_orden == $fin->id){
                        $evaluaciones[$admin->username] = $evaluaciones[$admin->username] + $evaluacion->evaluacion;
                        if($evaluacion->evaluacion == $request->estrellas){
                        $estrellas[$admin->username] = $estrellas[$admin->username] + 1;
                    }
                    }
                }
            }
        }
        foreach ($cat_tareas as $key => $tarea) {
            if($tarea->id == $fin->id_tarea){
                $tareas[$tarea->tarea] = $tareas[$tarea->tarea] + 1;
            }
        }
        foreach ($cat_areas as $key => $area) {
            if($area->id == $fin->id_area){
                $areas = $areas + [
                    $area->area => 0,
                ];
                $areas[$area->area] = $areas[$area->area] + 1;
            }
        }
    }

    $nombres = []; $total_user = 0;
    $users = $users->select('id_user', DB::raw('count(*) as total'))
                 ->orderBy('total', 'desc')
                 ->groupBy('id_user')->take(20)->get();
    $ides = [];
    foreach ($users as $key => $user) {
        $ides[$key] = $user->id_user;
    }
    $names = User::whereIn('id', $ides)->get();
    foreach ($users as $key => $user) {
        foreach ($names as $name) {
            if($name->id == $user->id_user){
                $usuarios = $usuarios + [
                $name->username => $users[$key]->total,
                ];
                $nombres = $nombres + [
                $name->username => $name->nombre.' '.$name->apepa.' '.$name->apema,
                ];   
                $total_user = $total_user + $users[$key]->total;
            }
        }
    }

    $respuesta['tecnicos']= $tecnicos;
    $respuesta['evaluacion']=$evaluaciones;
    $respuesta['tareas']=$tareas;
    $respuesta['areas']=$areas;
    $respuesta['total']=count($finalizadas);
    $respuesta['total2']=$total_user;
    $respuesta['estrellas']=$estrellas;
    $respuesta['usuarios']=$usuarios;
    $respuesta['nombres']=$nombres;

    return response()->json($respuesta);
}
}
