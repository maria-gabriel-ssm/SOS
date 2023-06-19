@extends('layouts.plantilla')
@section('title','Usuarios')
@section('content')

	<div class="container-fluid card p-4">
		<div class="row">
			<div class="col-md-12 table-responsive" id="scrole">
				<h6>Listado de participantes</h6>
				<table id="table" class="table align-items-center mb-0">
					<thead class="{{$bg->custombackground}} back-black rounded">
					    <tr>
					      <th class="text-uppercase text-xs font-weight-bolder rounded-left" scope="col">Nombre</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Area</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Cargo</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Contacto</th>
					      <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
						   <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Conferencia</th>
					    </tr>
					</thead>
					<tbody>
					  	@foreach($users as $user)
					    <tr class="border-bottom">
					      <td>
					      <span class="material-icons opacity-10 text-xs mr-2">person</span>{{$user->nombreCompleto}}</td>
					      <td>{{$user->area ? $user->area : 'NA' }}</td>
					      <td>{{$user->cargo ? $user->cargo : 'NA'}}</td>
					      <td>{{$user->email ? $user->email : 'NA'}}<br>
					      {{$user->telefono ? $user->telefono : 'NA'}}</td>
					      <td><span class="text-sm">{{$user->created_at->format('d/m/Y')}}</span></td>
					   	<td><a href="#" onclick="openiframe('Detalles de videoconferencia','{{ route('conferencias.show',$user->id_confe)}}')" class="btn btn-link text-primary text-gradient p-2 mb-0"><i class="material-icons text-sm me-2">remove_red_eye</i>Mostrar</a></td>
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