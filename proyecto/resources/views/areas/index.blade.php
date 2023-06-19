@extends('layouts.plantilla')
@section('title','Areas')
@section ('content')

<div class="container-fluid card p-4">
    <div class="row ">
        <div  class="col-md-12 table-responsive">
        	<h6>Areas</h6>
            <div class="row">
                <div class="col-12">
                    <button class="btn {{$bg->custom}} btn-sm float-right" onclick="openiframe('Nueva area','{{ route('areas.create')}}')">Crear area</button></div>
            </div>
        	<table id="table" class="table align-items-center mb-0">
                    <thead class="{{$bg->custombackground}} back-black rounded">
                        <tr>
                          <th class="text-uppercase text-xs font-weight-bolder rounded-left p-0 w-0 text-transparent" scope="col"></th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-0" scope="col">ID</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">CVE</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Area</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">ID Denegados</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Habilitado</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($areas as $key => $area)     
                        <tr id="{{$area->id}}" class="border-bottom">
                          <td></td>
                          <td>{{$area->id}}</td>
                          <td>{{$area->cve}}</td>
                          <td class="td-short" title="{{$area->area}}">{{$area->area}}</td>
                          <td>
                            {{$area->denegados=='' ? 'NA' : $area->denegados}}
                           <!-- @if($area->denegados=='')
                           NA
                           @else
                           <ul class="p-0">
                            @foreach($admins as $key => $admin)
                            @dump($area->denegados)
                            @dump($admin->id_user)
                            @if(strpos($area->denegados, '4') !== false)
                               <li>{{$admin->usuario->username}}</li>
                               @endif
                            @endforeach
                           </ul>
                           @endif -->
                          </td>
                          <td><span class="text-sm">{{$area->created_at->format('d/m/Y')}}</span></td>
                            @if($area->iactivo == 1)
                                <td><a class="switch" href="{{route('areas.inactivar',$area)}}">
                                  <input type="checkbox" disabled checked>
                                  <span class="slider round"></span>
                                </a></td>
                            @else
                                <td><a class="switch" href="{{route('areas.activar',$area)}}">
                                  <input type="checkbox" disabled>
                                  <span class="slider round"></span>
                                </a></td>
                            @endif
                            <td>
                                <a href="#" onclick="openiframe('Editar area','{{ route('areas.edit',$area->id)}}')" class="btn btn-link text-primary text-gradient p-2 mb-0"><i class="material-icons text-sm me-2">edit</i>Editar</a>
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
