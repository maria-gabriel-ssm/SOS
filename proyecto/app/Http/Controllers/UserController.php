<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Custom;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class UserController extends Controller
{
    public function index(){
        $users= User::all();
        $type = Admin::where('id_user', Auth::user()->id)->get()->last();
        $bg = Custom::where('id_user', 3)->get()->last();
       return view('usuarios.index',compact('users', 'bg','type'));        
    }
    public function perfil(){
       $bg = Custom::where('id_user', 3)->get()->last();
       $log = User::where('id', Auth::user()->id)->first(); 
       $area = Area::where('id', Auth::user()->area)->first(); 
       return view('usuarios.perfil',compact('log','area','bg'));     
    }
    public function create(){
       $bg = Custom::where('id_user', 3)->get()->last();
       $cat_area = Area::all()->pluck('area', 'id'); 
       return view('usuarios.create',compact('cat_area','bg'));     
    }
    public function update(Request $request, User $usuario){
        try{
        $usuario->area = $request->area;
        $usuario->sexo = $request->sexo;
        $usuario->telefono = $request->telefono;
        $usuario->update();

            return back()->with('ok', 'ok');

    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }

    }
    public function inactivar(User $usuario){
        $per = new User();
        $per = User::where('username', $usuario->username)->first();
        $per->iactivo=0;
        $per->update();
        return redirect()->route('usuarios.index');

    }
    public function activar(User $usuario){
        $per = new User();
        $per = User::where('username', $usuario->username)->first();
        $per->iactivo=1;
        $per->update();
        return redirect()->route('usuarios.index');
    }
    public function custom(Request $request){
        $bg = Custom::where('id_user', 3)->get()->last();
        $bg->customcolor = $request->custom;
        $bg->custom = 'btn-'.$request->custom;
        $bg->custombackground = 'bg-gradient-'.$request->custom.' active';
        $bg->custommode = $request->custom2;
        $bg->custommenu = $request->custom3;
        $bg->customother = $request->custom4;
        
        $bg->update();
        return back();
    }
    public function show(User $usuario){
        $bg = Custom::where('id_user', 3)->get()->last();
        $Admin=Admin::where('id_user',$usuario->id)->get()->first();
        $per=Admin::find($usuario->id_user);
        return view('usuarios.show',compact('usuario','bg'));
    }
    public function store(Request $request, User $usuario){
        try{
        $usuario->nombre=$request->nombre;
        $usuario->apepa=$request->apepa;
        $usuario->apema=$request->apema;
        // $usuario->tipo_usuario=$request->tipo;
        $usuario->update();

        return back()->with('ok', 'ok');
    }catch(\Exception $e){
            return back()->with('nook', $e->getMessage());
         }
    }
}
