<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepersonasRequest;
use App\Http\Requests\UpdatepersonasRequest;
use App\Models\Admin;
use App\Models\Custom;
use App\Models\User;
use App\Models\cat_clue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users_id = [];
       $bg = Custom::where('id_user', 3)->get()->last();
       $users = User::all();
       $type = Admin::where('id_user', Auth::user()->id)->get()->last();
       foreach ($users as $key => $user) {
           $users_id[$key] = $user->id;
       }

       $admins = Admin::WhereIn('id_user', $users_id)->orderBy('perfil', 'DESC')->get();
       return view('admins.index',compact('admins', 'bg','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admins.create');
    }
     public function inactivar(Admin $admin){
        $user = User::where('id', $admin->id_user)->get()->last();
        $user->tipo_usuario=1;
        $user->update();
        $admin->perfil=1;
        $admin->update();
        return redirect()->route('admins.index');
    }
     public function activar(Admin $admin){
        $user = User::where('id', $admin->id_user)->get()->last();
        $user->tipo_usuario=2;
        $user->update();
        $admin->perfil=3; 
        $admin->update();
        return redirect()->route('admins.index');
    }
    public function activartec(Admin $admin){
        $user = User::where('id', $admin->id_user)->get()->last();
        $user->tipo_usuario=2;
        $user->update();
        $admin->perfil=4; 
        $admin->update();
        return redirect()->route('admins.index');
    }
    public function noasistio(Admin $admin){
        $admin->estatus=2;
        $admin->update();
        return redirect()->route('admins.index');
    }
     public function asistio(Admin $admin){
        $admin->estatus=1;
        $admin->update();
        return redirect()->route('admins.index');
    }
    public function nodisponible(Admin $admin){
        $admin->disponible=2;
        $admin->update();
        return redirect()->route('admins.index');
    }
     public function disponible(Admin $admin){
        $admin->disponible=1;
        $admin->update();
        return redirect()->route('admins.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreadminsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $curpvali = Admin::where('curp',$request->curp)->first();
        $curp=$request->curp;
        $response = Http::get('http://200.33.79.33:8080/WS/restful/curp.json?curp='.$curp.'&token=b74d5196-4090-4829-b9bb-06d218639e3a');
         if($curpvali){
            
        }else{
        $per = new Admin();
        $per->nombre=$response['nombre'];
        $per->primerapell=$response['apellidoPaterno'];
        $per->segundoapell= $response['apellidoMaterno'];
        $per->curp=$request->curp;
        $per->iactivo=1;
        $per->id_usuario=Auth::user()->id;
        $per->save();
        
        echo '<script type="text/javascript">window.parent.errorinsertar("Exito","falla guardada");window.parent.recargar();</script>';
    }

    }
    catch(\Exception $e){
            echo '<script type="text/javascript">window.parent.errorinsertar("ERROR","Al incertar");</script>';
         }
             }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admins)
    {
        //
    }
    public function asignar(Admin $admin){
        $clues=cat_clue::all()->where('iactivo',1)->where('disponible',1)->pluck('Cluescompleto','id');
        return view ('admins.asignar',compact('admin','clues'));
    }
    public function cuenta(Request $request,Admin $admin){
        try{
        $uservali = User::where('username',$request->username)->first();
        if($uservali){
                return view('admins.asignar',compact('admin'))->with('documents')->with('errorlog','Este nombre de usuario ya se encuentra registrado');
            }else{
                $user = new User();
                $user->username= $request->username;
                $user->password='prueba';
                $user->tipo_usuario=$request->tipo_usuario;
                $user->id_admin=$admin->id;
                $user->id_clues=$request->clues;
                $user->iactivo=1;
                $user->save();
                echo '<script type="text/javascript">window.parent.errorinsertar("Exito","falla guardada");window.parent.recargar();</script>';
                
            }
             }
        catch(\Exception $e){
            return $e;
             echo '<script type="text/javascript">window.parent.errorinsertar("ERROR","Al incertar");</script>';
            // do task when error
          // insert query
         }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function edit(admins $admins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateadminsRequest  $request
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateadminsRequest $request, admins $admins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function destroy(admins $admins)
    {
        //
    }
}
