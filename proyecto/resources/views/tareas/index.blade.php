@extends('layouts.plantilla')
@section('title','Tareas')
@section ('content')

<div class="container-fluid card p-4">
    <div class="row ">
        <div  class="col-md-12 table-responsive">
        	<h6>Tareas</h6>
            <div class="row">
                <div class="col-12">
                    <button class="btn {{$bg->custom}} btn-sm float-right" onclick="openiframe('Nueva tarea','{{ route('tareas.create')}}')">Crear tarea</button></div>
            </div>
        	<table id="table" class="table align-items-center mb-0">
                    <thead class="{{$bg->custombackground}} back-black rounded">
                        <tr>
                          <th class="text-uppercase text-xs font-weight-bolder rounded-left p-0 w-0 text-transparent" scope="col"></th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-0" scope="col">ID</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Tarea</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Peso</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Habilitado</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tareas as $key => $tarea)     
                        <tr id="{{$tarea->id}}" class="border-bottom">
                          <td></td>  
                          <td>{{$tarea->id}}</td>
                          <td>{{$tarea->tarea}}</td>
                          <td>
                            @if($tarea->peso==1)
                            Bajo
                            @endif
                            @if($tarea->peso==2)
                            Medio
                            @endif
                            @if($tarea->peso==3)
                            Alto
                            @endif
                        </td>
                          <td><span class="text-sm">{{$tarea->created_at->format('d/m/Y')}}</span></td>
                            @if($tarea->iactivo == 1)
                                <td><a class="switch" href="{{route('tareas.inactivar',$tarea)}}">
                                  <input type="checkbox" disabled checked>
                                  <span class="slider round"></span>
                                </a></td>
                            @else
                                <td><a class="switch" href="{{route('tareas.activar',$tarea)}}">
                                  <input type="checkbox" disabled>
                                  <span class="slider round"></span>
                                </a></td>
                            @endif
                            <td>
                                <a href="#" onclick="openiframe('Editar tarea','{{ route('tareas.edit',$tarea->id)}}')" class="btn btn-link text-primary text-gradient p-2 mb-0"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                                <!-- <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Eliminar</a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>
		</div>
	</div>	
<script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

@endsection
