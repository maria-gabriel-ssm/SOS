@extends('layouts.plantilla')
@section('title','Historial')
@section ('content')

<div class="container-fluid card p-4">
    <div class="row ">
        <div  class="col-md-12 table-responsive">
            <h6>Historial de encargados </h6>
            <div class="row">
                <div class="col-12 inline-block">
                <select class="my-1 form-control form-lavender float-right w-lg-20 w-md-20 w-sm-100 d-inline" id="encargado">
                  <option value="">Filtrar por encargado</option>
                  @foreach($filtro as $filter)
                  <option value="{{$filter->usuario->nombreCompleto}}">{{$filter->usuario->nombreCompleto}}</option>
                  @endforeach
                </select>
                </div>
            </div>
            <table id="table" class="table align-items-center mb-0">
                    <thead class="{{$bg->custombackground}} back-black rounded">
                        <tr>
                          <th class="text-uppercase text-xs font-weight-bolder rounded-left p-0 w-0 text-transparent" scope="col"></th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-0" scope="col">ID</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Orden</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Encargado anterior</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Encargado actual</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1" scope="col">Creación</th>
                          <th class="text-uppercase text-xs font-weight-bolder pl-1 rounded-right" scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historial as $key => $histo)    
                        <tr class="border-bottom">
                          <td></td>
                          <td>{{$histo->id}}</td>
                          <td>{{$histo->id_orden}}</td>
                          <td class="td-short">{{$histo->anteriores ? $histo->anteriores->nombreCompleto : 'Sin asignar'}}</td>
                          <td>{{$histo->actuales ? $histo->actuales->nombreCompleto : 'Sin asignar'}}</td>
                          <td><span class="text-sm">{{$histo->created_at->format('d/m/Y')}}</span></td>
                          <td><a href="#" onclick="openiframe('Orden','{{ route('historial.show',$histo)}}')" class="btn btn-link text-dark p-2 mb-0"><i class="material-icons text-sm me-2">remove_red_eye</i>Mostrar</a></td>
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
