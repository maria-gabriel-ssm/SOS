<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Seguimiento;
use App\Models\Orden;
use App\Models\Admin;
use App\Models\Custom;

class SeguimientoController extends Controller
{
    //
    public function index()
    {
        $seguimientos = Seguimiento::all();
        return view('seguimientos.index',compact('seguimientos')); 
    }
    public function create(Orden $seguimiento)
    {
       $letter = [];
       $bg = Custom::where('id_user', 3)->get()->last();
       $comentarios = Seguimiento::where('id_orden', $seguimiento->id)->get();
       $orden = Orden::where('id', $seguimiento->id)->get()->last();
       foreach ($comentarios as $key => $comentario) {
        if(isset($comentario->admin)){
           $admin = Admin::where('id',$comentario->admin)->get()->last();
           $comentario->admin = $admin->usuario->username;
           $letter[$key] = substr($admin->usuario->username, 0, 1);
       }
       }
       return view('seguimientos.create',compact('comentarios', 'seguimiento','bg','letter'));
    }
    public function show(Orden $seguimiento)
    {
        $bg = Custom::where('id_user', 3)->get()->last();
       $comentarios = Seguimiento::where('id_orden', $seguimiento->id)->get();
       $orden = Orden::where('id', $seguimiento->id)->get()->last();
       $admin = Admin::where('id',$orden->id_admin)->get()->last();
       $letter = substr($admin->usuario->username, 0, 1);
       return view('seguimientos.show',compact('comentarios', 'seguimiento','bg','admin','letter'));
    }
    public function store(Request $request, Orden $seguimiento){
        try{

            $comen = new Seguimiento();
            $comen->comentario = $request->comentario;
            $comen->id_orden = $seguimiento->id;
            $admin = Admin::where('id_user',Auth::user()->id)->get()->last();
            $comen->admin = $admin->id;
            $comen->save();
        
        return back()->with('ok', 'ok');
         }
         catch(\Exception $e){
            return back()->with('nook', $e->getMessage());

         }
    }
}
