<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 
use App\Models\Custom;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Admin;
use App\Models\Conferencia;
use App\Models\Cancelacion;
use App\Models\Direccion;
use App\Models\Subdireccion;
use App\Models\Departamento;
use App\Models\Sede;
use App\Models\Persona;
use App\Mail\MailSend;

class ConferenciaController extends Controller
{
    public function index(){
        $rescan = [];
        $cancelaciones = Cancelacion::all();
        $bg = Custom::where('id_user', 3)->get()->last();
        
        if(Auth::user()->tipo_usuario == 2){
            $conferencias = Conferencia::where('estado', 1)->orderBy('created_at', 'DESC')->get();
        }else{
           $conferencias = Conferencia::orderBy('created_at', 'DESC')->get();
        }
        $type = Admin::where('id_user', Auth::user()->id)->get()->last();
        $cat_dir = Direccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sub = Subdireccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_dep = Departamento::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sed = Sede::where('iactivo',1)->pluck('nombre','id');

        foreach ($conferencias as $key => $conferencia) {
          $conferencia->feini = str_replace("T", " ", $conferencia->feini);
          $conferencia->fefin = substr($conferencia->fefin, -5);
            foreach ($cancelaciones as $cancel) {
            if($conferencia->id == $cancel->id_con){
                $rescan[$key] = 1;
            }
            }
        }

        return view('conferencias.index', compact('bg','conferencias','type','rescan'));
    }
    public function archivo(){
        $rescan = [];
        $cancelaciones = Cancelacion::all();
        $bg = Custom::where('id_user', 3)->get()->last();
        $conferencias = Conferencia::where('estado', 2)->orWhere('estado',3)->orderBy('created_at', 'DESC')->get();
        $type = Admin::where('id_user', Auth::user()->id)->get()->last();
        $cat_dir = Direccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sub = Subdireccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_dep = Departamento::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sed = Sede::where('iactivo',1)->pluck('nombre','id');

        foreach ($conferencias as $key => $conferencia) {
          $conferencia->feini = str_replace("T", " ", $conferencia->feini);
          $conferencia->fefin = substr($conferencia->fefin, -5);
            foreach ($cancelaciones as $cancel) {
            if($conferencia->id == $cancel->id_con){
                $rescan[$key] = 1;
            }
            }
        }

        return view('conferencias/archivo', compact('bg','conferencias','type','rescan'));
    }
    public function calendario(Request $request){
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_dir = Direccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sub = Subdireccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_dep = Departamento::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sed = Sede::where('iactivo',1)->pluck('nombre', 'id');
        $vc = [];
        if (Auth::user()->tipo_usuario == 2) {
            $confe = Conferencia::all();
        }else{
            $confe = Conferencia::where('estado',2)->get();
        }
        foreach ($confe as $key => $c) {
            if($c->estado == 1){
                $color = '#43A047';
            }elseif($c->estado == 2){
                $color = '#1A73E8';
            }elseif($c->estado == 3){
                $color = '#E53935';
            }
            $vc[] = [
            'id' => $c->id,
            'title' => $c->nombre,
            'start' => $c->feini,
            'end' => $c->fefin,
            'estado' => $c->estado,
            'color' => $color,
            ];
        }
        return view('conferencias.calendario',compact('vc','bg','cat_dir','cat_sub','cat_dep','cat_sed'));
    }
    public function create(Conferencia $conferencia)
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_dir = Direccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sub = Subdireccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_dep = Departamento::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sed = Sede::where('iactivo',1)->pluck('nombre', 'id');
       return view('conferencias.create',compact('conferencia','cat_dir','cat_sub','cat_dep','cat_sed','bg'));
    }
    public function show(Conferencia $conferencia)
    {
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_dir = Direccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sub = Subdireccion::where('iactivo',1)->pluck('nombre', 'id');
        $cat_dep = Departamento::where('iactivo',1)->pluck('nombre', 'id');
        $cat_sed = Sede::where('iactivo',1)->pluck('nombre', 'id');
        $receps= explode(",", $conferencia->receptores);
       return view('conferencias.show',compact('conferencia','cat_dir','cat_sub','cat_dep','cat_sed','bg','receps'));
    }
    public function view(Conferencia $conferencia)
    {
        $receptores=[];
        $bg = Custom::where('id_user', 3)->get()->last();
        $cat_sed = Sede::where('id',$conferencia->sede)->get()->last();
        $letter = $firstStringCharacter = substr($cat_sed->nombre, 0, 1);
        $conferencia->feini = str_replace("T", " ", $conferencia->feini);
        $conferencia->fefin = substr($conferencia->fefin, -5);;
        $cat_sed = Sede::all();
        $recep= explode(",", $conferencia->receptores);
        $iter = count($recep);
            $i=0;
            for($i=0;$i<$iter;$i++){
                foreach ($cat_sed as $key => $sed) {
                if($recep[$i] == $sed->id){
                    $receptores[$i] = $sed->nombre;
                }
            }
        }
       return view('conferencias.view',compact('conferencia','letter','bg','receptores'));
    }
    public function details(Request $request){
          $confe = Conferencia::where('id',$request->conferencia)->get()->last();
          if($confe->grabar == 1){
            $confe->grabar = "Solicito grabación.";
          }else{
            $confe->grabar = "";
          }
          $id_use = User::where('id', $confe->id_user)->get()->last();
          $id_dir = Direccion::where('id', $confe->id_dir)->get()->last();
          if($confe->id_sub != 0){
            $id_sub = Subdireccion::where('id', $confe->id_sub)->get()->last();
            $sub['nom_sub'] = $id_sub->nombre;
          }else {
            $sub['nom_sub'] = "NA";
          }
          if($confe->id_dep != 0){
            $id_dep = Departamento::where('id', $confe->id_dep)->get()->last();
            $dep['nom_dep'] = $id_dep->nombre;
          }else {
            $dep['nom_dep'] = "NA";
          }
          
          $dir['nom_dir'] = $id_dir->nombre;
          $use['telefono'] = $id_use->telefono;
          $ema['email'] = $id_use->email;
          // $equipo['nombre'] = Equipo::where('id', $confe->equipo)->get()->last();
          $nueva = $confe->toArray()+$dir+$sub+$dep+$use+$ema;
          return response()->json($nueva);
    }
    public function delete(Conferencia $conferencia){
        $bg = Custom::where('id_user', 3)->get()->last();
        // $comentario = Seguimiento::where('id_con', $conferencia->id)->get()->last();
        return view('conferencias.finalize',compact('conferencia','bg'));
    }
    public function cancelar(int $conferencia){
        $confe = Conferencia::where('id',$conferencia)->get()->last();
        try{
        $ups=User::where('id',$confe->id_user)->get()->last();
        $bg = Custom::where('id_user', 3)->get()->last();
        $confe->estado=3;
        $confe->update();

        $confe->feini = str_replace("T", " ", $confe->feini);
        $confe->fefin = substr($confe->fefin, -5);

        $type = "SSVC";
        $var = $ups;
        $con = $confe;
        $email = new MailSend($var, $con, $type);
        Mail::to($ups->email)->send($email);

        return back()->with('ok', 'ok');
        }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
    public function finish(Request $request, Conferencia $conferencia){
        try{
        $ups=User::where('id',$conferencia->id_user)->get()->last();
        $conferencia->estado=2;
        $conferencia->feini = str_replace("T", " ", $conferencia->feini);
        $conferencia->fefin = substr($conferencia->fefin, -5);
        $conferencia->link=$request->link;
        $conferencia->update();

        $emails = [];
        $iter = 0;
        $usuarios = User::where('tipo_usuario',2)->get();
        $admins = Admin::where('perfil',5)->get();
            foreach ($usuarios as $usuario) {
            foreach ($admins as $key => $admin) {
            if($admin->id_user == $usuario->id && $usuario->email != null && $usuario->email != ''){
                $emails[$key] = $usuario->email;
                $iter = $key;
            }
        }
        }

        $emails[$iter+1] = $ups->email;

        $type = "SSVA";
        $var = $ups;
        $con = $conferencia;
        $email = new MailSend($var, $con, $type);
        Mail::to($emails)->send($email);

        return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
    public function store(Request $request){
        try{
        if($request->has('id')){
        $up = Conferencia::where('id', $request->id)->get()->last();
        }
        if($request->has('id')){
        $ups=User::where('id',$request->id_user)->get()->last();
        $up->cargo = $request->cargo;
        $up->celular = $request->celular;
        $up->nombre = $request->evento;
        $up->id_dir = $request->direccion;
        // $up->id_sub = $request->subdireccion;
        if($request->subdireccion == null || $request->subdireccion == ''){
            $up->id_sub = 0;
        }else{
           $up->id_sub = $request->subdireccion;
        }
        if($request->departamento == null || $request->departamento == ''){
            $up->id_dep = 0;
        }else{
           $up->id_dep = $request->departamento;
        }
        $up->programa = $request->programa;
        $up->tipo = $request->tipo;
        $up->feini = $request->ini;
        $up->fefin = $request->fin;
        $up->sede = $request->sede;
        $up->emision = $request->emision;
        $up->participantes = $request->participantes;
        $up->comentarios = $request->comentarios;
        if($request->grabar == 'on'){
            $up->grabar = 1;
        }else{
            $up->grabar = 2;
        }
        $rec='';
        $iter = count($request->receptores);
            $i=0;
            for($i=0;$i<$iter;$i++){
                $rec=$rec.$request->receptores[$i].',';
            }
        $receptores = rtrim($rec, ", ");
        $up->receptores = $receptores;
        $ups->email = $request->email;
        $ups->telefono = $request->telefono;

        $ups->update();
        $up->update();

        return back()->with('ok', 'ok');
        }else{
        $use=User::where('id',Auth::user()->id)->get()->last();
        $con = new Conferencia();
        $con->id_user = Auth::user()->id;
        $con->cargo = $request->cargo;
        $con->celular = $request->celular;
        $con->nombre = $request->evento;
        $con->id_dir = $request->direccion;
        $con->id_sub = $request->subdireccion;
        if($request->subdireccion == null || $request->subdireccion == ''){
            $con->id_sub = 0;
        }else{
           $con->id_sub = $request->subdireccion;
        }
        if($request->departamento == null || $request->departamento == ''){
            $con->id_dep = 0;
        }else{
           $con->id_dep = $request->departamento;
        }
        $con->programa = $request->programa;
        $con->tipo = $request->tipo;
        $con->feini = $request->ini;
        $con->fefin = $request->fin;
        $con->sede = $request->sede;
        $con->emision = $request->emision;
        $con->participantes = $request->participantes;
        $con->comentarios = $request->comentarios;
        if($request->grabar == 'on'){
            $con->grabar = 1;
        }else{
            $con->grabar = 2;
        }
        $rec='';
        $iter = count($request->receptores);
            $i=0;
            for($i=0;$i<$iter;$i++){
                $rec=$rec.$request->receptores[$i].',';
            }
        $receptores = rtrim($rec, ", ");
        $con->receptores = $receptores;
        $use->email = $request->email;
        $use->telefono = $request->telefono;

        $use->save();
        $con->save();

        $con->feini = str_replace("T", " ", $con->feini);
        $con->fefin = substr($con->fefin, -5);

        $emails = [];
        $usuarios = User::where('tipo_usuario',2)->get();
        $admins = Admin::where('perfil',5)->get();
            foreach ($usuarios as $usuario) {
            foreach ($admins as $key => $admin) {
            if($admin->id_user == $usuario->id && $usuario->email != null && $usuario->email != ''){
                $emails[$key] = $usuario->email;
            }
        }
        }
        $type = "SSV";
        $var = $use;
        $email = new MailSend($var, $con, $type);
        Mail::to($emails)->send($email);
        return redirect()->route('conferencias.index')->with('ok', 'ok');
        }

    }catch(\Exception $e){
           return back()->with('nook', $e->getMessage());
         }
    }
}
