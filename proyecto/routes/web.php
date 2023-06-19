<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatAccesosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\contraresController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\CancelacionController;
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\ConferenciaController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\SubdireccionController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',['as'=>'login', function () {
    if(Auth::user()==null){
        return view('auth/login');
    }else{
        return redirect()->route('home');
    }
}]);
Route::get('/contrares', [contraresController::class,'index'])->name('contrares');
Route::post('contrares', [contraresController::class,'actua'])->name('actua');

Route::get('/asistencia/{asistencia}', [PersonaController::class,'asistencia'])->name('personas.asistencia');
Route::post('asistencia/registro', [PersonaController::class,'registro'])->name('personas.registro');
Route::get('tester', [PersonaController::class,'tester'])->name('personas.tester');
Route::get('carga', [PersonaController::class,'carga'])->name('personas.carga');

Auth::routes();
Route::group(['namespace'=>'admin', 'middleware' => 'val_acceso'],function(){

    Route::get('create/{cancelacion}/cancelacion',[CancelacionController::class,'create'])->name('cancelaciones.create');
    Route::get('show/{cancelacion}/cancelacion',[CancelacionController::class,'show'])->name('cancelaciones.show');
    Route::post('guardar/{cancelacion}/cancelacion', [CancelacionController::class,'store'])->name('cancelaciones.store');
    
    Route::post('detalles/subdireccion', [SubdireccionController::class,'details'])->name('subdirecciones.details');
    Route::post('detalles/departamento', [DepartamentoController::class,'details'])->name('departamentos.details');
    Route::post('detalles/conferencia', [ConferenciaController::class,'details'])->name('conferencias.details');

    Route::get('conferencias',[ConferenciaController::class,'index'])->name('conferencias.index');
    Route::get('archivo', [App\Http\Controllers\ConferenciaController::class, 'archivo'])->name('archivo');
    Route::get('calendario',[ConferenciaController::class,'calendario'])->name('conferencias.calendario');
    Route::get('create/conferencia',[ConferenciaController::class,'create'])->name('conferencias.create');
    Route::get('show/{conferencia}/conferencia',[ConferenciaController::class,'show'])->name('conferencias.show');
    Route::get('view/{conferencia}/conferencia',[ConferenciaController::class,'view'])->name('conferencias.view');
    Route::post('guardar/conferencia/{conferencia?}', [ConferenciaController::class,'store'])->name('conferencias.store');
    Route::get('finalize/conferencia/{conferencia}', [ConferenciaController::class,'delete'])->name('conferencias.finalize');
    Route::post('finalizar/conferencia/{conferencia}', [ConferenciaController::class,'finish'])->name('conferencias.finish');
    Route::get('cancelar/conferencia/{conferencia}', [ConferenciaController::class,'cancelar'])->name('conferencias.cancelar');

    Route::get('direcciones',[DireccionController::class,'index'])->name('direcciones.index');
    Route::get('create/direccion',[DireccionController::class,'create'])->name('direcciones.create');
    Route::get('edit/{direccion}/direccion',[DireccionController::class,'create'])->name('direcciones.edit');
    Route::post('guardar/direccion/{direccion?}', [DireccionController::class,'store'])->name('direcciones.store');
    Route::get('direcciones/activar/{direccion}', [DireccionController::class,'activar'])->name('direcciones.activar');
    Route::get('direcciones/inactivar/{direccion}', [DireccionController::class,'inactivar'])->name('direcciones.inactivar');

    Route::get('subdirecciones',[SubdireccionController::class,'index'])->name('subdirecciones.index');
    Route::get('create/subdireccion',[SubdireccionController::class,'create'])->name('subdirecciones.create');
    Route::get('edit/{subdireccion}/subdireccion',[SubdireccionController::class,'create'])->name('subdirecciones.edit');
    Route::post('guardar/subdireccion/{subdireccion?}', [SubdireccionController::class,'store'])->name('subdirecciones.store');
    Route::get('subdirecciones/activar/{subdireccion}', [SubdireccionController::class,'activar'])->name('subdirecciones.activar');
    Route::get('subdirecciones/inactivar/{subdireccion}', [SubdireccionController::class,'inactivar'])->name('subdirecciones.inactivar');

    Route::get('departamentos',[DepartamentoController::class,'index'])->name('departamentos.index');
    Route::get('create/departamento',[DepartamentoController::class,'create'])->name('departamentos.create');
    Route::get('edit/{departamento}/departamento',[DepartamentoController::class,'create'])->name('departamentos.edit');
    Route::post('guardar/departamento/{departamento?}', [DepartamentoController::class,'store'])->name('departamentos.store');
    Route::get('departamentos/activar/{departamento}', [DepartamentoController::class,'activar'])->name('departamentos.activar');
    Route::get('departamentos/inactivar/{departamento}', [DepartamentoController::class,'inactivar'])->name('departamentos.inactivar');

    Route::get('sedes',[SedeController::class,'index'])->name('sedes.index');
    Route::get('create/sede',[SedeController::class,'create'])->name('sedes.create');
    Route::get('edit/{sede}/sede',[SedeController::class,'create'])->name('sedes.edit');
    Route::post('guardar/sede/{sede?}', [SedeController::class,'store'])->name('sedes.store');
    Route::get('sedes/activar/{sede}', [SedeController::class,'activar'])->name('sedes.activar');
    Route::get('sedes/inactivar/{sede}', [SedeController::class,'inactivar'])->name('sedes.inactivar');

    Route::get('personas',[PersonaController::class,'index'])->name('personas.index');
    Route::get('create/persona',[PersonaController::class,'create'])->name('personas.create');
    Route::get('show/{conferencia}/persona',[PersonaController::class,'show'])->name('personas.show');
    Route::post('guardar/persona/{persona?}', [PersonaController::class,'store'])->name('personas.store');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('expediente', [App\Http\Controllers\HomeController::class, 'expediente'])->name('expediente');
    Route::post('guardar/orden', [HomeController::class,'store'])->name('home.store');
    Route::get('finalize/orden/{orden}', [HomeController::class,'delete'])->name('home.finalize');
    Route::post('finalizar/orden/{orden}', [HomeController::class,'finish'])->name('home.finish');
    Route::get('accesos',[CatAccesosController::class,'index'])->name('accesos.index');
    Route::get('create',[CatAccesosController::class,'create'])->name('accesos.create');
    Route::post('acceso', [CatAccesosController::class,'store'])->name('accesos.store');
    Route::get('acceso/{acceso}', [CatAccesosController::class,'show'])->name('accesos.show');
    Route::put('acceso/{acceso}', [CatAccesosController::class,'update'])->name('accesos.update');
    Route::get('acceso/{acceso}/inactivar', [CatAccesosController::class,'inactivar'])->name('accesos.inactivar');
    Route::get('acceso/{acceso}/activar', [CatAccesosController::class,'activar'])->name('accesos.activar');
    Route::get('ordenes',[OrdenController::class,'index'])->name('ordenes.index');
    Route::post('guardar2/orden/{orden?}', [OrdenController::class,'store'])->name('orden.store');
    Route::get('create/orden',[OrdenController::class,'create'])->name('ordenes.create');
    Route::get('show/{orden}/orden',[OrdenController::class,'show'])->name('ordenes.show');

    Route::get('reportes/ordenes',[OrdenController::class,'reporte'])->name('reportes.ordenes');
    Route::post('reportes/tecnicos', [OrdenController::class,'reporte_tec'])->name('reportes.tecnicos');

    Route::get('tareas',[TareaController::class,'index'])->name('tareas.index');
    Route::get('create/tareas',[TareaController::class,'create'])->name('tareas.create');
    Route::get('edit/{tarea}/tarea',[TareaController::class,'create'])->name('tareas.edit');
    Route::get('tareas/activar/{tarea}', [TareaController::class,'activar'])->name('tareas.activar');
    Route::get('tareas/inactivar/{tarea}', [TareaController::class,'inactivar'])->name('tareas.inactivar');
    Route::post('guardar/tarea/{tarea?}', [TareaController::class,'store'])->name('tareas.store');

    Route::get('areas',[AreaController::class,'index'])->name('areas.index');
    Route::get('create/areas',[AreaController::class,'create'])->name('areas.create');
    Route::get('edit/{area}/area',[AreaController::class,'create'])->name('areas.edit');
    Route::get('areas/activar/{area}', [AreaController::class,'activar'])->name('areas.activar');
    Route::get('areas/inactivar/{area}', [AreaController::class,'inactivar'])->name('areas.inactivar');
    Route::post('guardar/area/{area?}', [AreaController::class,'store'])->name('areas.store');

    Route::get('equipos',[EquipoController::class,'index'])->name('equipos.index');
    Route::get('create/equipos',[EquipoController::class,'create'])->name('equipos.create');
    Route::get('edit/{equipo}/equipo',[EquipoController::class,'create'])->name('equipos.edit');
    Route::get('equipos/activar/{equipo}', [EquipoController::class,'activar'])->name('equipos.activar');
    Route::get('equipos/inactivar/{equipo}', [EquipoController::class,'inactivar'])->name('equipos.inactivar');
    Route::post('guardar/equipo/{equipo?}', [EquipoController::class,'store'])->name('equipos.store');

    Route::get('historial',[HistorialController::class,'index'])->name('historial.index');
    Route::post('guardar/historial', [HistorialController::class,'store'])->name('historial.store');
    Route::get('create/{id_orden}/historial',[HistorialController::class,'create'])->name('historial.create');
    Route::get('show/{orden}/historial',[HistorialController::class,'show'])->name('historial.show');

    Route::post('detalles/orden', [OrdenController::class,'details'])->name('orden.details');
    Route::get('reload/orden', [OrdenController::class,'reload'])->name('orden.reload');
    Route::get('create/{seguimiento}',[SeguimientoController::class,'create'])->name('seguimientos.create');
    Route::get('show/{seguimiento}/seguimiento',[SeguimientoController::class,'show'])->name('seguimientos.show');
    Route::post('guardar/{seguimiento}/seguimiento', [SeguimientoController::class,'store'])->name('seguimientos.store');

    Route::get('create/{evaluacion}/evaluacion',[EvaluacionesController::class,'create'])->name('evaluaciones.create');
    Route::get('show/{evaluacion}/evaluacion',[EvaluacionesController::class,'show'])->name('evaluaciones.show');
    Route::post('guardar/{evaluacion}/evaluacion', [EvaluacionesController::class,'store'])->name('evaluaciones.store');

    Route::get('create/admin/admin',[AdminController::class,'create'])->name('admins.create');
    Route::get('/admins/activar/{admin}', [AdminController::class,'activar'])->name('admins.activar');
    Route::get('/admins/activartec/{admin}', [AdminController::class,'activartec'])->name('admins.activartec');
    Route::get('/admins/inactivar/{admin}', [AdminController::class,'inactivar'])->name('admins.inactivar');
    Route::get('/admins/asistio/{admin}', [AdminController::class,'asistio'])->name('admins.asistio');
    Route::get('/admins/noasistio/{admin}', [AdminController::class,'noasistio'])->name('admins.noasistio');
    Route::get('/admins/disponible/{admin}', [AdminController::class,'disponible'])->name('admins.disponible');
    Route::get('/admins/nodisponible/{admin}', [AdminController::class,'nodisponible'])->name('admins.nodisponible');
    Route::get('admins',[AdminController::class,'index'])->name('admins.index');
    Route::post('guardar/admin', [AdminController::class,'store'])->name('admins.store');
    Route::get('admins/asignar/{admin}', [AdminController::class,'asignar'])->name('admins.asignar');
    Route::post('admins/usuario/{admin}', [AdminController::class,'cuenta'])->name('admins.cuenta');
    Route::get('usuarios',[UserController::class,'index'])->name('usuarios.index');
    Route::get('usuarios/perfil',[UserController::class,'perfil'])->name('usuarios.perfil');
    Route::get('/usuarios/inactivar/{usuario}', [UserController::class,'inactivar'])->name('usuarios.inactivar');
    Route::get('/usuarios/{usuario}', [UserController::class,'activar'])->name('usuarios.activar');
    Route::post('/usuarios/custom', [UserController::class,'custom'])->name('usuarios.custom');
    Route::post('editar/{usuario}', [UserController::class,'store'])->name('usuarios.store');
    Route::get('show/{usuario}', [UserController::class,'show'])->name('usuarios.show');
    Route::get('create/usuarios/usuario', [UserController::class,'create'])->name('usuarios.create');
    Route::post('usuarios/update/{usuario}', [UserController::class,'update'])->name('usuarios.update');

    Route::get('pdf/orden/{orden}', [PDFController::class,'generatePDF'])->name('pdf.show');
    Route::get('pdf/conferencia/{conferencia}', [PDFController::class,'generatePDF_Conf'])->name('pdf_conf.show');

});