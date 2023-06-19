 @if (auth::user())
 @if (auth::user()->iactivo !=1 )    
 @php
 header("Location: " . URL::to('/'), true, 302);
 exit();
 @endphp  
 @endif            
 @else
 @php
 header("Location: " . URL::to('/'), true, 302);
 exit();
 @endphp 
 @endif

 @extends('layouts.plantilla')
 <style type="text/css">
   .exploder{
      padding-left: 1rem;
      cursor: pointer;
   }
   .explode{
      font-size: .8rem;
   }
   .explode p{
      font-size: .8rem;
   }
   .text-estado{
      font-size: 0.875rem !important;
      font-weight: 600;
      padding: 9px 10px 9px 10px;
      color: #fff;
      border-radius: 2px;
   }
   .text-estado .badge{
      color: white;
      position: absolute;
      font-size: 0.3rem;
      margin-left: 3px;
      margin-top: -7px;
      background: red;
   }
   .text-a{
      cursor: pointer;
      color: #344767;
   }
   .line-center{
      position: absolute;
      padding-top: 2px;
   }
   .fondo{
      background-color: lavender!important;
      color: #344767;
   }
</style>
@section('content')
@if(Auth::user()->tipo_usuario==2)
<div class="container-fluid card p-4">
   <div class="row">
      @env('ordenes.show')
      <div  class="col-md-12 table-responsive" id="scrole">
         <h6>Solicitudes de ordenes</h6>
         @env('ordenes.create')
         <div class="row mb-2">
            <div class="col-12 inline-block">
               @if($type->perfil==2 || $type->perfil==4 || $type->perfil==5)
               <button id="holi" class="btn {{$bg->custom}} btn-sm float-right" onclick="openiframe('Nueva orden','{{ route('ordenes.create')}}')">Crear orden</button>
               @endif
            <!-- <select class="my-1 form-control form-lavender w-20 d-inline" id="estado">
               <option value="">Filtrar por estado</option>
               <option value="En curso">En curso</option>
               <option value="Finalizada">Finalizada</option>
            </select> -->
            <select class="my-1 form-control form-lavender w-lg-20 w-md-20 w-sm-100 d-inline" id="prioridad">
               <option value="">Filtrar por prioridad</option>
               <option value="Uno">Hace un día</option>
               <option value="Dos">Haces dos días</option>
               <option value="Tres">Haces +dos días</option>
            </select>
            @if($type->perfil==2 || $type->perfil==3)
            <select class="my-1 form-control form-lavender w-lg-20 w-md-20 w-sm-100 d-inline" id="encargado">
               <option value="">Filtrar por encargado</option>
               <option value="Pendiente">Pendiente</option>
               @foreach($filtro as $filter)
               <option value="{{$filter->usuario->nombreCompleto}}">{{$filter->usuario->nombreCompleto}}</option>
               @endforeach
            </select>
            @endif
         </div>
      </div>
      @endenv
      <table id="table" class="table align-items-center mb-0">
         <thead class="{{$bg->custombackground}} back-black rounded">
            <tr>
               <th class="text-uppercase text-xs font-weight-bolder p-0 rounded-left text-transparent" scope="col"></th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">NO</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Usuario</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Tarea</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Técnico</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Estado</th>
            </tr>
         </thead>
         <tbody id="tbody">
            @foreach($ordenes as $key => $orden)
            @if($type->perfil==2 || $type->perfil==3)
            @if($fechas[$key] < $bg->customother)
            <tr id="{{$orden->id}}">
               <td class="exploder text-center details-control"><span class="fa fa-chevron-down"></span></td>
               <td>
                  <span class="text-a" onclick="openiframe('Editar orden','{{ route('ordenes.show',$orden->id)}}')">{{$orden->id}}</span>
               </td>
               <td class="td-short" title="{{$orden->name}}">{{$orden->name}}</td>
               <td class="td-short" title="{{$orden->tarea->tarea}}">{{$orden->tarea->tarea}}</td>
               <td><span class="text-a" onclick="openiframe('Reasignar orden','{{ route('historial.create',$orden->id)}}')">{{$orden->administrador->usuario->nombreCompleto ?? 'Pendiente'}}<i class="p-1 ml-1 rounded-circle material-icons text-sm">remove_red_eye</i></span></td>
               <td><span class="text-sm">{{$orden->created_at->format('d/m/Y h:i')}}</span></td>
               <td>
                  @if($orden->estado==1)
                  <a class="pointer" onclick="openiframe('','{{ route('home.finalize',$orden)}}')"><span class="text-estado {{$fechas[$key]==2 ? 'bg-warning' : 'bg-success'}} 
                     {{$fechas[$key]>2 ? 'bg-danger' : ''}} {{$orden->estado==2 ? 'bg-info' : ''}}"><i class="material-icons text-white text-sm line-center">check_box</i>&nbsp;&nbsp;&nbsp;&nbsp;En curso&nbsp;&nbsp;</span></a>
                     <p class="d-none">@if($fechas[$key]==2)
                        Dos
                        @elseif($fechas[$key]>2)
                        Tres
                        @else
                        Uno
                        @endif
                     </p>
                     <span class="text-estado bg-dark pointer" onclick="openiframe('Comentarios orden','{{ route('seguimientos.create',$orden->id)}}')"><i class="material-icons text-sm scale">email</i><span class="badge badge-light rounded-circle float-right {{isset($rescom[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                     @else
                     <a href="{{ route('pdf.show',$orden) }}" target="_blank"><span class="text-estado bg-info"><i class="material-icons text-white text-sm line-center">download</i>&nbsp;&nbsp;&nbsp;&nbsp;Finalizada</span></a>
                     <span class="text-estado bg-primary pointer" onclick="openiframe('Calificación','{{ route('evaluaciones.show',$orden->id)}}')"><i class="material-icons  text-sm scale">thumb_up</i></span>
                     @endif
                  </td>
               </tr>
               @endif
               @endif
               @if($orden->id_admin == $type->id && ($type->perfil==4 || $type->perfil==5)) 
               <tr id="{{$orden->id}}">
                  <td class="exploder text-center details-control"><span class="fa fa-chevron-down"></span></td>
                  <td>
                     <a>
                        {{$orden->id}}
                     </td>
                     <td class="td-short" title="{{$orden->name}}">{{$orden->name}}</td>
                     <td class="td-short" title="{{$orden->tarea->tarea}}">{{$orden->tarea->tarea}}</td>
                     <td>{{$orden->administrador->usuario->nombreCompleto ?? 'Pendiente'}}</td>
                     <td><span class="text-sm">{{$orden->created_at->format('d/m/Y h:i')}}</span></td>
                     <td>
                        @if($orden->estado==1)
                        <a class="pointer" onclick="openiframe('','{{ route('home.finalize',$orden)}}')"><span class="text-estado {{$fechas[$key]==2 ? 'bg-warning' : 'bg-success'}} 
                           {{$fechas[$key]>2 ? 'bg-danger' : ''}} {{$orden->estado==2 ? 'bg-info' : ''}}"><i class="material-icons text-white text-sm line-center">check_box</i>&nbsp;&nbsp;&nbsp;&nbsp;En curso&nbsp;&nbsp;</span></a>
                           <p class="d-none">@if($fechas[$key]==2)
                              Dos
                              @elseif($fechas[$key]>2)
                              Tres
                              @else
                              Uno
                              @endif
                           </p>
                           <span class="text-estado bg-dark pointer" onclick="openiframe('Comentarios orden','{{ route('seguimientos.create',$orden->id)}}')"><i class="material-icons text-white text-sm scale">email</i><span class="badge badge-light rounded-circle float-right {{isset($rescom[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                           @else
                           <a href="{{ route('pdf.show',$orden) }}" target="_blank"><span class="text-estado bg-info"><i class="material-icons text-white text-sm line-center">download</i>&nbsp;&nbsp;&nbsp;&nbsp;Finalizada</span></a>
                           <span class="text-estado bg-primary pointer" onclick="openiframe('Calificación','{{ route('evaluaciones.show',$orden->id)}}')"><i class="material-icons text-white text-sm scale">thumb_up</i></span>
                           @endif
                        </td>
                     </tr>
                     @endif
                     @endforeach
                  </tbody>
               </table>
               <div class="row justify-content-end">
                  <div class="col-12 text-right opacity-8 mt-4">
                     <span class="badge badge-sm bg-gradient-success m-1">Hoy o hace 1 día</span>
                     <span class="badge badge-sm bg-gradient-warning m-1">Hace 2 días</span>
                     <span class="badge badge-sm bg-gradient-danger m-1">Hace +2 días</span>  
                  </div>
               </div>
            </div>
            @endenv
         </div>
      </div>
      @else
      <div class="container-fluid card p-4">
         {!! Form::open(array('route' => array('home.store'),'method'=>'post','class'=>'container')) !!}
         <div class="row ">
            <h6>Solicitar orden</h6>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Nombre') !!}
               {!! Form::text('nombre',$user->nombreCompleto,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre completo', 'required'))!!}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Area') !!}
               {{ Form::select('area', $cat_area, Auth::user()->area, ['class' => 'form-control','id'=>'cat_area','placeholder'=>'Seleccione un departamento','required'])}}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Teléfono') !!}
               {!! Form::text('telefono',Auth::user()->telefono,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Teléfono ó extensión', 'required', 'pattern' => '[0-9]{4,10}', 'title'=> 'Ingresa minimo una extensión a cuatro dígitos'))!!}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Tarea') !!}
               {{ Form::select('tarea', $cat_tarea, '', ['class' => 'form-control','id'=>'cat_tarea','placeholder'=>'Seleccione tarea solicitada','required'])}}
               <a id="soli18" href="http://192.168.10.79/portal/descargables/servicios_internos/Formato%20solicitud%20de%20cuenta%20de%20usuario%20.pdf" class="d-none" target="_blank"><label class="pointer m-0 mt-1 text-info">&nbsp;<u>Formato de solicitud a entregar</u></label></a> 
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Equipo') !!}
               {{ Form::select('equipo', $cat_equipo, '', ['class' => 'form-control','id'=>'cat_equipo','placeholder'=>'Seleccione tipo de equipo','required'])}}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Descripción') !!}
               {!! Form::textarea('descripcion','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Favor de ingresar una descripción sólida.', 'rows' => 1, 'required'))!!}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-white d-flex align-self-end mt-3">
               <button class="btn {{$bg->custom}} btn-block m-0 pt-sm-2" type="submit">Solicitar</button>
            </div>
            <br>
            {!! Form::close() !!}
         </div>
      </div>

      <div id="alerta" class="position-fixed top-6 end-2 w-lg-30 w-sm-100 alert alert-primary-opacity alert-dismissible fade show" role="alert"><a class="text-white text-sm" href="{{ url('ordenes') }}"><i class="material-icons text-white text-sm scale px-1">thumb_up</i> No olvides <strong>calificar</strong> tus ordenes finalizadas.</a>
         <button type="button" class="close pt-2" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
         </button>
      </div>
      @endif
      <script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
      <script type="text/javascript">

        $(document).ready(function(){
         if(localStorage.getItem('menu')!='true'){
              $('#loginModal').modal('show');
              localStorage.setItem("menu",'true');
           }
      });

      $('#cat_tarea').on('change', function() {
         if(this.value == 18){
            $("#soli18").removeClass('d-none');
         }else{
            $("#soli18").addClass('d-none');
         }
         });

        if ($(window).width() < 700) {
           $("#alerta").removeClass('end-2');
        }
        $('#alerta').fadeIn('slow').delay(4500).hide(0);

        @if (session('ok'))
        setTimeout(() => {
           $("#successToast").toast("show");
        }, 200);
        @endif
        @if (session('nook'))
        setTimeout(() => {
           $("#dangerToast").toast("show");
        }, 200);
        @endif

        var fila=[],j=0;
        $('#table').on( 'click','.exploder', function () {
         if($(this).children("span").hasClass('fa fa-chevron-down'))
         {
           $(this).children("span").removeClass('fa fa-chevron-down');
           $(this).children("span").addClass('fa fa-chevron-up');
        }
        else
        {
           $(this).children("span").removeClass('fa fa-chevron-up');
           $(this).children("span").addClass('fa fa-chevron-down');
        }
        var tr= $(this).closest('tr');
        if($.inArray(tr.attr('id'),fila)==-1){
           fila[j]=tr.attr('id');
           var orden=tr.attr('id');
           j++;
           $.ajax({
            url: 'detalles/orden',
            method:'POST',
            dataType: "json",
            data: {
             "_token": $("meta[name='csrf-token']").attr("content"),
             "orden":orden
          },
          async: false,
          success: function (respuesta) {
           console.log(respuesta);
           var table='<tr class="explode agregados'+tr.attr("id")+'"><td class="p-0 fondo"></td><td colspan="7" class="p-0 fondo"><div class="row text-no-nowrap border-radius-lg py-3 px-2 m-2"><div class="col-3"><p class="mb-1 text-bold"> Descripción </p>'+respuesta.descripcion+'</div><div class="col-3"><p class="mb-1 text-bold"> Equipo </p>'+respuesta.nombre['equipo']+'</div><div class="col-3"><p class="mb-1 text-bold"> Teléfono </p>'+respuesta.telefono+'</div><div class="col-3"><p class="mb-1 text-bold"> Area </p>'+respuesta.area+'</div></td></tr>';
           $(tr).after(table);
        },
     });
        }else{
           $(".agregados"+tr.attr("id")).remove();
           fila = $.grep(fila, function(value) {
             return value != tr.attr('id');
          });
        }
     }); 

  </script>
  @endsection