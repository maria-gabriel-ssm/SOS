
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
        @env('ordenes.show')
        <div  class="col-md-12 table-responsive" id="scrole">
            <h6>Expediente de ordenes</h6>
            @env('ordenes.create')
            <div class="row">
                <div class="col-12 inline-block">
                    @if($type->perfil==2 || $type->perfil==3)
                    <select class="my-1 form-control form-lavender float-right w-lg-20 w-md-20 w-sm-100 d-inline" id="encargado">
                      <option value="">Filtrar por encargado</option>
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
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Encargado</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Finalización</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach($ordenes as $key => $orden)
                        @if($type->perfil==2 || $type->perfil==3)
                        <tr id="{{$orden->id}}">
                          <td class="exploder text-center details-control"><span class="fa fa-chevron-down"></span></td>
                          <td style="padding-bottom: 0.7rem; padding-top: 0.7rem;">
                            <span>{{$orden->id}}</span>
                          </td>
                          <td class="td-short" style="max-width: 170px;" title="{{$orden->name}}">{{$orden->name}}</td>
                          <td class="td-short" style="max-width: 170px;" title="{{$orden->tarea->tarea}}">{{$orden->tarea->tarea}}</td>
                          <td class="td-short" style="max-width: 170px;" title="{{$orden->administrador->usuario->nombreCompleto}}">{{$orden->administrador->usuario->nombreCompleto ?? 'Pendiente'}}</td>
                          <td><span class="text-sm">{{$orden->created_at->format('d/m/Y h:i')}}</span></td>
                          <td><span class="text-sm">{{$orden->updated_at->format('d/m/Y h:i')}}</span></td>
                          <td>
                            <a href="{{ route('pdf.show',$orden) }}" target="_blank"><span class="text-estado bg-info"><i class="material-icons text-white text-sm line-center scale">download</i>&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
                            <span class="text-estado bg-primary pointer" onclick="openiframe('Calificación','{{ route('evaluaciones.show',$orden->id)}}')"><i class="material-icons  text-sm scale">thumb_up</i><span class="badge badge-light rounded-circle float-right {{isset($reseva[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                          </td>
                        </tr>
                        @endif

                        @if($orden->id_admin == $type->id && ($type->perfil==4 || $type->perfil==5)) 
                        <tr id="{{$orden->id}}">
                          <td class="exploder text-center details-control"><span class="fa fa-chevron-down"></span></td>
                          <td><a>{{$orden->id}}</td>
                          <td class="td-short" title="{{$orden->name}}">{{$orden->name}}</td>
                          <td class="td-short" title="{{$orden->tarea->tarea}}">{{$orden->tarea->tarea}}</td>
                          <td>{{$orden->administrador->usuario->nombreCompleto ?? 'Pendiente'}}</td>
                          <td><span class="text-sm">{{$orden->created_at->format('d/m/Y')}}</span></td>
                          <td>
                            <a href="{{ route('pdf.show',$orden) }}" target="_blank"><span class="text-estado bg-info"><i class="material-icons text-white text-sm line-center">download</i>&nbsp;&nbsp;&nbsp;&nbsp;Finalizada</span></a>
                            <span class="text-estado bg-primary pointer" onclick="openiframe('Calificación','{{ route('evaluaciones.show',$orden->id)}}')"><i class="material-icons text-white text-sm scale">thumb_up</i><span class="badge badge-light rounded-circle float-right {{isset($reseva[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
        </div>
        @endenv
    </div>
</div>
 
<script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script type="text/javascript">

    localStorage.setItem('res','');
    @if(session('ok'))
    localStorage.setItem('res','ok');
    window.parent.closeModal();
    @elseif(session('nook'))
    localStorage.setItem('res','{{Session::get('nook')}}');
    window.parent.closeModal();
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
