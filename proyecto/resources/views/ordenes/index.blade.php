@extends('layouts.plantilla')
@section('title','Ordenes')
@section ('content')

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
        /*background-color: lightblue !important;*/
        font-size: 0.875rem !important;
        font-weight: 600;
        padding: 8px 10px 8px 10px;
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
    .scale{
        transform: scale(1.4);
    }
    .fondo{
        background-color: lavender!important;
        color: #344767;
    }

</style>
<div class="container-fluid card p-4">
    <div class="row ">
        <div  class="col-md-12 table-responsive">
        	<h6>Mis ordenes</h6>
        	<table id="table" class="table align-items-center mb-0">
                    <thead class="{{$bg->custombackground}} back-black rounded">
                        <tr>
                          <th class="text-uppercase text-xs font-weight-bolder p-0 rounded-left text-transparent" scope="col"></th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">NO</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Tarea</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Técnico</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Fecha</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordenes as $key => $orden)
                        @if($fechas[$key] < $bg->customother)  
                        <tr id="{{$orden->id}}">
                        	<td class="exploder text-center"><span class="fa fa-chevron-down"></span></td>
                          <td>{{$orden->id}}</td>
                          <td>{{$orden->tarea->tarea}} <a id="soli18" href="http://192.168.10.79/portal/descargables/servicios_internos/Formato%20solicitud%20de%20cuenta%20de%20usuario%20.pdf" class="{{$orden->tarea->id == 18 ? '' : 'd-none'}}" target="_blank"><label class="text-sm pointer m-0 mt-1 text-info">&nbsp;<u>Descargar formato</u></label></a></td>
                          <td>{{$orden->administrador->usuario->nombreCompleto ?? 'Pendiente'}}</td>
                          <td><span class="text-sm">{{$orden->created_at->format('d/m/Y')}}</span></td>
                          <td>
                            @if($orden->estado==1)
                            <span class="text-estado exploder bg-success">&nbsp;En curso&nbsp;</span>
                            <span class="text-estado bg-dark pointer" onclick="openiframe('Comentarios','{{ route('seguimientos.show',$orden->id)}}')"><i class="material-icons text-white text-sm scale">email</i><span class="badge badge-light rounded-circle float-right {{isset($rescom[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
                            @else
                            <span class="text-estado bg-info">Finalizada</span>
                            <span class="text-estado bg-primary pointer" onclick="openiframe('Calificación','{{ route('evaluaciones.create',$orden->id)}}')"><i class="material-icons text-white text-sm scale">thumb_up</i><span class="badge badge-light rounded-circle float-right {{isset($reseva[$key]) ? 'visible' : 'invisible'}}">&nbsp;</span></span>
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
        var table='<tr class="explode agregados'+tr.attr("id")+'"><td class="p-0 fondo"></td><td colspan="6" class="p-0 fondo"><div class="row text-no-nowrap border-radius-lg py-3 px-2 m-2"><div class="col-3"><p class="mb-1 text-bold"> Descripción </p>'+respuesta.descripcion+'</div><div class="col-3"><p class="mb-1 text-bold"> Equipo </p>'+respuesta.nombre['equipo']+'</div><div class="col-3"><p class="mb-1 text-bold"> Teléfono </p>'+respuesta.telefono+'</div><div class="col-3"><p class="mb-1 text-bold"> Area </p>'+respuesta.area+'</div></td></tr>';
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
