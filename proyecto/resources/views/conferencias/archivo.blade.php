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
   .scale{
   transform: scale(1.4);
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
<div class="container-fluid card p-4">
<div class="row">
   <div  class="col-md-12 table-responsive" id="scrole">
      <h6>{{Auth::user()->tipo_usuario==2 ? 'Solicitudes de videoconferencias' : 'Mis videoconferencias'}}</h6>
      <div class="row">
         <div class="col-12 inline-block text-right">
            <select class="my-1 form-control form-lavender w-lg-20 w-md-20 w-sm-100 d-inline" id="prioridad">
               <option value="">Filtrar por estado</option>
               <option value="Agendada">Agendada</option>
               <option value="Cancelada">Cancelada</option>
            </select>
         </div>
      </div>
      <table id="table" class="table align-items-center mb-0">
         <thead class="{{$bg->custombackground}} back-black rounded">
            <tr>
               <th class="text-uppercase text-xs font-weight-bolder p-0 rounded-left text-transparent" scope="col"></th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">VSSM</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Usuario</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Nombre evento</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Sede emisora</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Fecha y hora</th>
               <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Estado</th>
            </tr>
         </thead>
         <tbody id="tbody">
            @foreach($conferencias as $key => $conferencia)
            @if(Auth::user()->tipo_usuario==2)
            <tr id="{{$conferencia->id}}">
               <td class="exploder text-center details-control"><span class="fa fa-chevron-down"></span></td>
               <td>
                  <span class="text-a" onclick="openiframe('Editar conferencia','{{ route('conferencias.show',$conferencia->id)}}')">{{$conferencia->id}}<i class="p-1 ml-1 rounded-circle material-icons text-sm">edit</i></span>
               </td>
               <td class="td-short" title="{{$conferencia->name}}">{{$conferencia->usuario->nombreCompleto}}
                  <p class="d-none">@if($conferencia->estado==2)
               Agendada
               @elseif($conferencia->estado==3)
               Cancelada
               @endif
               </p></td>
               <td class="td-short" title="{{$conferencia->nombre}}">{{$conferencia->nombre}}</td>
               <td><span class="text-sm">{{$conferencia->sedes->nombre}}</span></td>
               <td><span class="text-sm">{{$conferencia->feini}}/{{$conferencia->fefin}}</span></td>
               <td>
                  @if($conferencia->estado==1)
                  <a class="pointer" onclick="openiframe('','{{ route('conferencias.finalize',$conferencia)}}')"><span class="text-estado bg-success"><i class="material-icons text-white text-sm line-center">check_box</i>&nbsp;&nbsp;&nbsp;&nbsp;Pendiente&nbsp;&nbsp;</span></a>
                  <span class="text-estado bg-dark pointer" onclick="openiframe('Solicitud cancelación / reagendación','{{ route('cancelaciones.show',$conferencia->id)}}')"><i class="material-icons text-white text-sm scale">event_busy</i><span class="badge badge-light rounded-circle float-right {{isset($rescan[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                  @elseif($conferencia->estado==2)
                  <a href="{{ route('pdf_conf.show',$conferencia) }}" target="_blank"><span class="text-estado bg-info"><i class="material-icons text-white text-sm line-center">download</i>&nbsp;&nbsp;&nbsp;&nbsp;Agendada&nbsp;&nbsp;</span></a>
                  <span class="text-estado bg-primary pointer" onclick="openiframe('Participantes conferencia','{{ route('personas.show',$conferencia->id)}}')">
                     <i class="material-icons text-white text-sm scale">group</i>
                  </span>
                  @elseif($conferencia->estado==3)
                  <a class="pointer"><span class="text-estado bg-danger exploder"><i class="material-icons text-white text-sm line-center">delete_forever</i>&nbsp;&nbsp;&nbsp;&nbsp;Cancelada&nbsp;</span></a>
                  <span class="text-estado bg-dark pointer" onclick="openiframe('Cancelación conferencia / reagendación','{{ route('cancelaciones.show',$conferencia->id)}}')"><i class="material-icons text-white text-sm scale">event_busy</i><span class="badge badge-light rounded-circle float-right {{isset($rescan[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                  @endif
               </td>
            </tr>
            @elseif($conferencia->id_user == Auth::user()->id && Auth::user()->tipo_usuario==1)
            <tr id="{{$conferencia->id}}">
               <td class="exploder text-center details-control"><span class="fa fa-chevron-down"></span></td>
               <td>
                  <span class="text-a" onclick="openiframe('Editar conferencia','{{ route('conferencias.show',$conferencia->id)}}')">{{$conferencia->id}}<i class="p-1 ml-1 rounded-circle material-icons text-sm">edit</i></span>
               </td>
               <td class="td-short" title="{{$conferencia->name}}">{{$conferencia->usuario->nombreCompleto}}</td>
               <td class="td-short" title="{{$conferencia->nombre}}">{{$conferencia->nombre}}</td>
               <td><span class="text-sm">{{$conferencia->sedes->nombre}}</span></td>
               <td><span class="text-sm">{{$conferencia->feini}}</span></td>
               <td>
                  @if($conferencia->estado==1)
                  <a class="pointer"><span class="text-estado bg-success exploder"><i class="material-icons text-white text-sm line-center">check_box</i>&nbsp;&nbsp;&nbsp;&nbsp;Pendiente&nbsp;&nbsp;</span></a>
                  <span class="text-estado bg-dark pointer" onclick="openiframe('Cancelación / reagendación conferencia','{{ route('cancelaciones.create',$conferencia->id)}}')"><i class="material-icons text-white text-sm scale">event_busy</i><span class="badge badge-light rounded-circle float-right {{isset($rescan[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                  @elseif($conferencia->estado==2)
                  <a href="{{ route('pdf_conf.show',$conferencia) }}" target="_blank"><span class="text-estado bg-info"><i class="material-icons text-white text-sm line-center">download</i>&nbsp;&nbsp;&nbsp;&nbsp;Agendada&nbsp;&nbsp;</span></a>
                  <span class="text-estado bg-primary pointer">
                     <i class="material-icons text-white text-sm scale">group</i>
                  </span>
                  @elseif($conferencia->estado==3)
                  <a class="pointer"><span class="text-estado bg-danger exploder"><i class="material-icons text-white text-sm line-center">check_box</i>&nbsp;&nbsp;&nbsp;&nbsp;Cancelada&nbsp;</span></a>
                  <span class="text-estado bg-dark pointer" onclick="openiframe('Cancelación / reagendación conferencia','{{ route('cancelaciones.create',$conferencia->id)}}')"><i class="material-icons text-white text-sm scale">event_busy</i><span class="badge badge-light rounded-circle float-right {{isset($rescan[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                  @endif
               </td>
            </tr>
            @endif
            @endforeach
         </tbody>
      </table>
   </div>
</div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script type="text/javascript">
   $("#titulo").text('Solicitud de Videoconferencias');
   
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
       var conferencia=tr.attr('id');
       j++;
   $.ajax({
      url: 'detalles/conferencia',
      method:'POST',
      dataType: "json",
      data: {
        "_token": $("meta[name='csrf-token']").attr("content"),
        "conferencia":conferencia
      },
      async: false,
      success: function (respuesta) {
       console.log(respuesta);
       var table='<tr class="explode agregados'+tr.attr("id")+'"><td class="p-0 fondo"></td><td colspan="7" class="p-0 fondo"><div class="row text-no-nowrap border-radius-lg py-3 px-2 m-2"><div class="col-3"><p class="mb-1 text-bold"> Dirección / Subdirección / Departamento </p> • '+respuesta.nom_dir+'<br>• '+respuesta.nom_sub+'<br>• '+respuesta.nom_dep+'</div><div class="col-3"><p class="mb-1 text-bold"> Detalles </p> • Tipo conferencia: '+respuesta.tipo+'<br>• Lugar emisión: '+respuesta.emision+'<br>• No. participantes: '+respuesta.participantes+'</div><div class="col-3"><p class="mb-1 text-bold"> Contacto </p>• Cel.'+respuesta.celular+'<br>• Tel.'+respuesta.telefono+'<br>• Email.'+respuesta.email+'</div><div class="col-3"><p class="mb-1 text-bold"> Comentarios </p>'+respuesta.comentarios+'<br>'+respuesta.grabar+'</div></td></tr>';
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