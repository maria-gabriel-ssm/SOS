@extends('layouts.plantilla')
@section('title','Sedes')
@section ('content')

<div class="container-fluid card p-4">
    <div class="row ">
        <div  class="col-md-12 table-responsive">
        	<h6>Sedes</h6>
            <div class="row">
                <div class="col-12">
                    <button class="btn {{$bg->custom}} btn-sm float-right" onclick="openiframe('Nueva sede','{{ route('sedes.create')}}')">Crear sede</button></div>
            </div>
        	<table id="table" class="table align-items-center mb-0">
                    <thead class="{{$bg->custombackground}} back-black rounded">
                        <tr>
                          <th class="text-uppercase text-xs font-weight-bolder rounded-left p-0 w-0 text-transparent" scope="col"></th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-0" scope="col">ID</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Sede</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Habilitado</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sedes as $key => $sede)     
                        <tr id="{{$sede->id}}" class="border-bottom">
                          <td></td>
                          <td>{{$sede->id}}</td>
                          <td class="td-short" title="{{$sede->nombre}}">{{$sede->nombre}}</td>
                          <td><span class="text-sm">{{$sede->created_at->format('d/m/Y')}}</span></td>
                            @if($sede->iactivo == 1)
                                <td><a class="switch" href="{{route('sedes.inactivar',$sede)}}">
                                  <input type="checkbox" disabled checked>
                                  <span class="slider round"></span>
                                </a></td>
                            @else
                                <td><a class="switch" href="{{route('sedes.activar',$sede)}}">
                                  <input type="checkbox" disabled>
                                  <span class="slider round"></span>
                                </a></td>
                            @endif
                            <td>
                                <a href="#" onclick="openiframe('Editar subdirección','{{ route('sedes.edit',$sede->id)}}')" class="btn btn-link text-primary text-gradient p-2 mb-0"><i class="material-icons text-sm me-2">edit</i>Editar</a>
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
