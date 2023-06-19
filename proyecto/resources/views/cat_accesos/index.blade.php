@extends('layouts.plantilla')
@section('title','Permisos')
@section ('content')
<div class="container-fluid card p-4">
			<h6>Permisos de rutas</h6>
            <div class="row">
                <div class="col-12">
                    <button class="btn {{$bg->custom}} btn-sm float-right" onclick="openiframe('Nueva ruta','{{ route('accesos.create')}}')">Crear permiso</button></div>
            </div>
        	<table id="table" class="table">
				<thead class="{{$bg->custombackground}} back-black rounded">
			    <tr>
			      <th class="text-uppercase text-xs font-weight-bolder rounded-left" scope="col">ID</th>
			      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Ruta</th>
			      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Nombre</th>
			      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Usuarios</th>
			      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
			      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Habilitado</th>
			      <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Acción</th>
			    </tr>
			  </thead>
			  @if (!empty($accesos))
			  <tbody>
			      @foreach ($accesos as $acceso)
			  <tr>
			  	<td class="text-center">{{$acceso->id}}</td>
			  	<td class="td-short">{{$acceso->ruta}}</td>
			  	<td>{{$acceso->name}}</td>
			  	<td>@if($acceso->tipo_usuarios_id=='1')
			      	Normal
			      	@elseif($acceso->tipo_usuarios_id=='2')
			      	Master
			      	@elseif($acceso->tipo_usuarios_id=='1,2')
			      	Normal, Master
			      	@elseif($acceso->tipo_usuarios_id=='1,3')
			      	Normal, Admin
			      	@elseif($acceso->tipo_usuarios_id=='1,4')
			      	Normal, Técnico
			      	@elseif($acceso->tipo_usuarios_id=='2,3')
			      	Master, Admin
			      	@elseif($acceso->tipo_usuarios_id=='2,4')
			      	Master, Técnico
			      	@elseif($acceso->tipo_usuarios_id=='3,4')
			      	Admin, Técnico
			      	@elseif($acceso->tipo_usuarios_id=='1,2,3')
			      	Normal, Master, Admin
			      	@elseif($acceso->tipo_usuarios_id=='1,2,4')
			      	Normal, Master, Técnico
			      	@elseif($acceso->tipo_usuarios_id=='2,3,4')
			      	Master, Admin, Técnico
			      	@elseif($acceso->tipo_usuarios_id=='1,2,3,4')
			      	Normal, Master, Admin, Técnico
			      	@endif
			  	</td>
			  	<td><span class="text-sm">{{$acceso->created_at->format('d/m/Y')}}</span></td>
					@if($acceso->iactivo == 1)
					      		<td><a class="switch" href="{{ route('accesos.inactivar',$acceso) }}">
								  <input type="checkbox" disabled checked>
								  <span class="slider round"></span>
								</a></td>
					      	@else
					      		<td><a class="switch" href="{{ route('accesos.activar',$acceso) }}">
								  <input type="checkbox" disabled>
								  <span class="slider round"></span>
								</a></td>
					      	@endif
	          <td>
                                <a href="#" onclick="openiframe('Ver ruta','{{ route('accesos.show',$acceso)}}')" class="btn btn-link text-primary text-gradient p-2 mb-0"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                                <!-- <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Eliminar</a> -->
                            </td>
			  </tr>
			  	  @endforeach    
			  </tbody>
			  @endif
			  </table>
</div>
<script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
<script type='text/javascript'  src="{{ URL::asset('js/app.js') }}" ></script>
@endsection