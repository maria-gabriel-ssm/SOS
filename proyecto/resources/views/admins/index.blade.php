@extends('layouts.plantilla')
@section('title','Admins')
@section ('content')
<style type="text/css">

</style>

<div class="container-fluid card p-4">
    <div class="row ">
        <div  class="col-md-12">
        	<h6>Listado de admins </h6>
        	<table id="table" class="table align-items-center mb-0">
					<thead class="{{$bg->custombackground}} back-black rounded">
					    <tr>
					      <th class="text-uppercase text-xs font-weight-bolder rounded-left p-0 w-0 text-transparent" scope="col"></th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-0" scope="col">Nombre de usuario</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Tipo de usuario</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Asistencia</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Disponible</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Permisos {{$type->perfil==2 ? 'Admin' : 'Técnico'}}</th>
					    </tr>
					</thead>
					<tbody>
					  	@foreach($admins as $admin)	
					    <tr class="border-bottom">
					      <td></td>
					      <td><span class="material-icons opacity-10 text-xs mr-2">person</span>{{$admin->usuario->username}}</td>
					      <td>
					      	@if($admin->perfil==1)
					      	Deshabilitado
					      	@endif
					      	@if($admin->perfil==2)
					      	Master
					      	@endif
					      	@if($admin->perfil==3)
					      	Admin
					      	@endif
					      	@if($admin->perfil==4)
					      	Técnico
					      	@endif
					      	@if($admin->perfil==5)
					      	Técnico 2
					      	@endif
					      </td>
					      <td><span class="text-sm">{{$admin->usuario->created_at->format('d/m/Y')}}</span></td>
					      @if($admin->estatus == 1)
						      <td><a class="switch" href="{{ route('admins.noasistio',$admin) }}">
								  <input type="checkbox" disabled checked>
								  <span class="slider round"></span>
								</a></td>
						    @elseif($admin->estatus == 2)
						      <td><a class="switch" href="{{ route('admins.asistio',$admin) }}">
								  <input type="checkbox" disabled>
								  <span class="slider round"></span>
								</a></td>
					      	@endif
					      	@if($admin->disponible == 1)
						      <td><a class="switch" href="{{ route('admins.nodisponible',$admin) }}">
								  <input type="checkbox" disabled checked>
								  <span class="slider round"></span>
								</a></td>
						    @elseif($admin->disponible == 2)
						      <td><a class="switch" href="{{ route('admins.disponible',$admin) }}">
								  <input type="checkbox" disabled>
								  <span class="slider round"></span>
								</a></td>
					      	@endif
					      	@if($admin->usuario->tipo_usuario == 2)
						      <td><a class="switch" href="{{ route('admins.inactivar',$admin) }}">
								  <input type="checkbox" disabled checked>
								  <span class="slider round"></span>
								</a></td>
						    @elseif($admin->usuario->tipo_usuario == 1 && $type->perfil==2)
						      <td><a class="switch" href="{{ route('admins.activar',$admin) }}">
								  <input type="checkbox" disabled>
								  <span class="slider round"></span>
								</a></td>
								@elseif($admin->usuario->tipo_usuario == 1 && $type->perfil==3)
						      <td><a class="switch" href="{{ route('admins.activartec',$admin) }}">
								  <input type="checkbox" disabled>
								  <span class="slider round"></span>
								</a></td>
					      	@endif
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