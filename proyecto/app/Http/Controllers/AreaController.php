<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\User;
use App\Models\Admin;
use App\Models\Custom;

class AreaController extends Controller
{
    //
    public function index()
    {   
        $bg = Custom::where('id_user', 3)->get()->last();
        $areas = Area::orderBy('created_at', 'DESC')->get();
        $admins = Admin::all();
       return view('areas.index',compact('areas', 'bg','admins'));   
    }
    public function inactivar(Area $area){
        $area->iactivo=0;
        $area->update();
        return redirect()->route('areas.index');
    }
     public function activar(Area $area){
        $area->iactivo=1;
        $area->update();
        return redirect()->route('areas.index');
    }
    public function create(Area $area)
    {  
        $i=0;
        $checkperfil = [];
        $bg = Custom::where('id_user', 3)->get()->last();
        $admins = User::where('tipo_usuario', 2)->get();
        $den= explode(",", $area->denegados);
        $iter = count($den);

        foreach ($admins as $key => $admin) {
            for($i=0;$i<$iter;$i++){
            $checkperfil[$key]=0;
            }
            for($i=0;$i<$iter;$i++){
                if($den[$i]==$admin->id){
                    // dump('den '.$den[$i]. ' = '.$admin->id);
                    $checkperfil[$key]=1;
                    // dump('check-'.$key.': '. $checkperfil[$key]);
                }
                
            }
            
       }
        return view('areas.create',compact('area', 'bg','admins','checkperfil'));
       
    }
    public function store(Request $request, Area $area){
        try{
            $up = Area::where('id', $area->id)->get()->last();
        if($up){
            $up->cve=$request->cve;
            $up->area=$request->area;

            $admins = Admin::all()->last();
            $iter = $admins->id_user+1;
            $acc= explode(",", $area->denegados);
            $perfile='';
            $perfiles='';
            $i=1;
            for($i=1;$i<$iter;$i++){
                if($request->$i=='on'){

                    $perfile=$perfile.$i.',';
                }
            }
            $perfiles = rtrim($perfile, ", ");
            $up->denegados=$perfiles;
            // dump($perfile);
            $up->update();
        }else{
            $tar = new Area();
            $tar->cve=$request->cve;
            $tar->area=$request->area;

            $admins = Admin::all()->last();
            $iter = $admins->id_user+1;
            $perfile='';
            $i=1;
            for($i=1;$i<$iter;$i++){
                if($request->$i=='on'){
                    $perfile=$perfile.$i.',';
                }
            }
            $perfiles = rtrim($perfile, ", ");
            $tar->denegados=$perfiles;

            $tar->save();
        } 
        
            return back()->with('ok', 'ok');

    }catch(\Exception $e){
           return back()->with('nook', $e->getMessage());
         }
    }
}
