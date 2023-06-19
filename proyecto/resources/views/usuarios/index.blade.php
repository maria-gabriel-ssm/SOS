@extends('layouts.plantilla')
@section('title','Usuarios')
@section('content')

	<div class="container-fluid card p-4">
		<div class="row">
			<div class="col-md-12 table-responsive">
				<h6>Listado de usuarios</h6>
				<table id="table" class="table align-items-center mb-0">
					<thead class="{{$bg->custombackground}} back-black rounded">
					    <tr>
					      <th class="text-uppercase text-xs font-weight-bolder rounded-left" scope="col">Nombre</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Usuario</th>
					      @if($type->perfil==2)
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Tipo de usuario</th>
					      @endif
					      @if($type->perfil==5)
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Email</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Telefono</th>
					      @endif
					      <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Creación</th>
					      @if($type->perfil==2)
						   <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col" >Habilitado</th>
						   <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col" >Acción</th>
						   @endif
					    </tr>
					</thead>
					<tbody>
					  	@foreach($users as $user)
					  		
					    <tr class="border-bottom">
					      <td>
					      	<span class="material-icons opacity-10 text-xs mr-2">person</span>{{$user->nombreCompleto}}</td>
					      	<td>{{$user->username}}</td>
					      @if($type->perfil==2)
					      <td>
					      	@if($user->tipo_usuario==1)
					      	Normal
					      	@elseif($user->tipo_usuario==2)
					      	Administrador
					      	@endif
					      </td>
					      @endif
					      @if($type->perfil==5)
					      <td>
					      {{$user->email ? $user->email : 'NA'}}
					      </td>
					      <td>
					      {{$user->telefono ? $user->telefono : 'NA'}}
					      </td>
					      @endif
					      <td><span class="text-sm">{{$user->created_at->format('d/m/Y')}}</span></td>
					      @if($type->perfil==2)
					      	@if($user->iactivo == 1)
					      		<td><a class="switch" href="{{route('usuarios.inactivar',$user)}}">
								  <input type="checkbox" disabled checked>
								  <span class="slider round"></span>
								</a></td>
					      	@else
					      		<td><a class="switch" href="{{route('usuarios.activar',$user)}}">
								  <input type="checkbox" disabled>
								  <span class="slider round"></span>
								</a></td>
					      	@endif
					   	<td><a href="#" onclick="openiframe('Editar usuario','{{ route('usuarios.show',$user)}}')" class="btn btn-link text-primary text-gradient p-2 mb-0"><i class="material-icons text-sm me-2">remove_red_eye</i>Mostrar</a></td>
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