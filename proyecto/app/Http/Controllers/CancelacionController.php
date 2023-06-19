<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; 
use App\Models\Cancelacion;
use App\Models\User;
use App\Models\Admin;
use App\Models\Conferencia;
use App\Models\Custom;
use App\Mail\MailSend;

class CancelacionController extends Controller
{
    //
    public function index()
    {
        $cancelaciones = Cancelacion::all();
        return view('cancelaciones.index',compact('cancelaciones')); 
    }
    public function create(Conferencia $cancelacion)
    {
     $bg = Custom::where('id_user', 3)->get()->last();
     $comentario = Cancelacion::where('id_con', $cancelacion->id)->get()->last();
     return view('cancelaciones.create',compact('comentario', 'cancelacion','bg'));
 }
 public function show(Conferencia $cancelacion)
 {
     $comentario = Cancelacion::where('id_con', $cancelacion->id)->get()->last();
     return view('cancelaciones.show',compact('comentario', 'cancelacion'));
 }
 public function store(Request $request, Conferencia $cancelacion){
    try{
        $cancel = Cancelacion::where('id_con', $cancelacion->id)->get()->last();
        $confe = Conferencia::where('id',$cancelacion->id)->get()->last();
        $ups=User::where('id',$confe->id_user)->get()->last();
        if($request->operacion == "Reagendar"){
            $confe->feini = $request->ini;
                $confe->fefin = $request->fin;
                $confe->update();

                $confe->feini = str_replace("T", " ", $confe->feini);
                $confe->fefin = str_replace("T", " ", $confe->fefin);

                $type = "SSVU";
                $var = $ups;
                $con = $confe;
                $email = new MailSend($var, $con, $type);
                Mail::to($ups->email)->send($email);

                return back()->with('ok', 'ok');
        }else{
            if(!$cancel){
            $comen = new Cancelacion();
            $comen->comentario = $request->comentario;
            $comen->id_con = $cancelacion->id;
            $comen->save();

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

            $ups->area = $comen->comentario;
            $type = "SSVS";
            $var = $ups;
            $email = new MailSend($var, $confe, $type);
            Mail::to($emails)->send($email);
 
        } 
        $cancel = Cancelacion::where('id_con', $cancelacion->id)->get()->last();
        if($cancel){
            
            if($request->operacion == "Cancelar"){
            $cancel->comentario = $request->comentario;
            $cancel->update();
            $ups=User::where('id',$confe->id_user)->get()->last();
            $confe->estado=3;
            $confe->update();

            $confe->feini = str_replace("T", " ", $confe->feini);
            $confe->fefin = substr($confe->fefin, -5);

            $type = "SSVC2";
            $var = $cancel;
            $con = $confe;
            $email = new MailSend($var, $con, $type);
            Mail::to($ups->email)->send($email);
            }
        }
        }
        return back()->with('ok', 'ok');
    }
    catch(\Exception $e){
        return back()->with('nook', $e->getMessage());

    }
}
}
