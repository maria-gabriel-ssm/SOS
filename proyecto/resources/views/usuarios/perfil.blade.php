@extends('layouts.plantilla')
@section('title','Mi perfil')
@section ('content')
<div class="container-fluid p-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="{{$bg->custombackground}} custom-header border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Mi perfil</h6>
              </div>
            </div>
            <!--Display only lg md-->
            <div class="card-body px-0 pb-2 d-none d-sm-block">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Area</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creación cuenta</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            @if(Auth::user()->sexo == '1')
                            <img src="{{URL::asset('/image/avatar/user-male.gif')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            @elseif(Auth::user()->sexo == '2')
                            <img src="{{URL::asset('/image/avatar/user-famele.gif')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            @endif
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{Auth::user()->nombreCompleto}}</h6>
                            <p class="text-xs text-secondary mb-0">{{Auth::user()->username}}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">{{$area->area ?? 'No asignado'}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <h6 class="mb-0 text-sm">{{Auth::user()->telefono ?? 'No asignado'}}</h6>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$log->created_at ?? 'NA'}}</span>
                      </td>
                      <td class="align-middle">
                        @if($bg->custommode=='dark-version')
                        <a href="#" onclick="openiframe('Editar perfil','{{ route('usuarios.create')}}')" class="btn btn-white bold text-gradient px-3 mb-0" style="box-shadow: none;"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                        @else
                        <a href="#" onclick="openiframe('Editar perfil','{{ route('usuarios.create')}}')" class="btn btn-link text-{{$bg->customcolor}} bold text-gradient px-3 mb-0"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!--Display only sm-->
            <div class="card-body px-0 pb-2 text-center d-block d-sm-none d-xs-none">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <tbody>
                    <tr>
                      @if(Auth::user()->sexo == '1')
                      <img src="{{URL::asset('/image/avatar/user-male.gif')}}" class="avatar avatar-sm border-radius-lg" alt="user1">
                      @elseif(Auth::user()->sexo == '2')
                      <img src="{{URL::asset('/image/avatar/user-famele.gif')}}" class="avatar avatar-sm border-radius-lg" alt="user1">
                      @endif
                    </tr>
                    <tr>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{Auth::user()->nombreCompleto}}</h6>
                        <p class="text-xs text-secondary mb-0">{{Auth::user()->username}}</p>
                      </div>
                      <p class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</p>
                      </tr>
                      <tr class="col-12">
                        <p class="text-xs text-secondary mb-0">{{$area->area ?? 'No asignado'}}</p>
                        <p class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Area</p>
                      </tr>
                      <tr class="col-12 align-middle text-center text-sm">
                        <h6 class="mb-0 text-sm">{{Auth::user()->telefono ?? 'No asignado'}}</h6>
                        <p class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telefono</p>
                      </tr>
                      <tr class="col-12 align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$log->created_at ?? 'NA'}}</span>
                        <p class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creacion</p>
                      </tr>
                      <tr class="col-12 align-middle">
                        @if($bg->custommode=='dark-version')
                        <a href="#" onclick="openiframe('Editar perfil','{{ route('usuarios.create')}}')" class="btn btn-white bold text-gradient px-3 mb-0" style="box-shadow: none;"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                        @else
                        <a href="#" onclick="openiframe('Editar perfil','{{ route('usuarios.create')}}')" class="btn btn-link text-{{$bg->customcolor}} bold text-gradient px-3 mb-0"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                        @endif
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
            </div>
            
          
</div>
<script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

<script type="text/javascript">
  $("#titulo").text('Configuración de Cuenta');
</script>

 @endsection