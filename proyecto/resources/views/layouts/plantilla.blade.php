
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    
<script src="https://code.jquery.com/jquery-3.2.1.js"
integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
      <!-- Styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="{{ url('/css/plantilla.css') }}" /> -->
  <!--Dashboard SOS-->
  <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard-sos.css') }}" />
  
    <!--Datarangepicker--->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="icon" class="rounded-circle" href="{{URL::asset('/image/ssm_logo_32.png')}}">
    <title>@yield('title')</title>

    <style type="text/css">
        body{
            max-width: 100%;
            overflow-x:hidden;
        }

        .menu-img:hover {
          -webkit-transform:scale(1.2);
          -moz-transform:scale(1.2);
          -ms-transform:scale(1.2);
          -o-transform:scale(1.2);
          transform:scale(1.2);
          }
    </style>
   
<body class="g-sidenav-show bg-gray-200 min-vh-100 {{$bg->custommode}}">
   <div class="wrapper">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 {{$bg->custommenu}}" id="sidenav-main">
    <div class="sidenav-header p-2 {{$bg->custommenu}} text-center">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      @if($bg->custommenu=='bg-gradient-dark' || $bg->custommenu=='bg-transparent')
      <a href="https://www.ssm.gob.mx" target="_blank">
        <img src="{{URL::asset('/image/ssm_logo_blanco.png')}}" alt="logo_SSM" class="img-responsive navbar-brand-img">
      </a>
      @else
      <a href="https://www.ssm.gob.mx" target="_blank">
        <img src="{{URL::asset('/image/ssm_logo.png')}}" alt="logo_SSM" class="img-responsive navbar-brand-img">
      </a>
      @endif
    </div>
        {!! Form::hidden('',$bg->custommenu,array('class' => '', 'id' => 'c'))!!}
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          @if(isset($type))
          <a class="nav-link text-white {{ (request()->is('home')) ? $bg->custombackground : '' }} {{ ((request()->is('conferencias')) && $type->perfil==5) ? $bg->custombackground : '' }}
" href="{{ url('/home') }}">
          @else
          <a class="nav-link text-white {{ (request()->is('home')) ? $bg->custombackground : '' }}
" href="{{ url('/home') }}">
          @endif
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>
        @if(Auth::user()->tipo_usuario==1)
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('ordenes')) ? $bg->custombackground : '' }} " href="{{ url('ordenes') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Mis ordenes</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->tipo_usuario==2)
        @env('expediente')
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('expediente')) ? $bg->custombackground : '' }}
" href="{{ url('expediente') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">folder</i>
            </div>
            <span class="nav-link-text ms-1">Expediente</span>
          </a>
        </li>
        @endenv
        <!-- <li class="nav-item">
          <a class="nav-link text-white dropdown-toggle" href="#usua" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">group</i>
            </div>
            <span class="nav-link-text ms-1">Usuarios</span>
          </a>
          <ul class="collapse list-unstyled" id="usua">
                    @env('accesos.index')
                      <li class="nav-link-text">
                          <a class="nav-link text-white" href="{{ route('usuarios.index') }}">Usuarios</a>
                      </li>
                      <li class="nav-link-text">
                          <a class="nav-link text-white" href="{{ route('accesos.index') }}">Permisos</a>
                      </li>
                       <li class="nav-link-text">
                          <a class="nav-link text-white" onclick="openiframe('Nueva ruta','{{ route('accesos.create')}}')">Añadir ruta</a>
                      </li>
                      @endenv
                </ul>  
        </li> -->
        @env('usuarios.index')
        <li class="nav-item">
        <a class="nav-link text-white {{ (request()->is('usuarios')) ? $bg->custombackground : '' }} {{ (request()->is('accesos')) ? $bg->custombackground : '' }} {{ (request()->is('admins')) ? $bg->custombackground : '' }} {{ (request()->is('equipos')) ? $bg->custombackground : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">supervised_user_circle</i>
            </div>
            <span class="nav-link-text ms-1 w-100">Usuarios</span><i class="material-icons opacity-10 text-white text-right fs-6">keyboard_arrow_down</i>
        </a>
        <div class="dropdown-menu mx-3" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('usuarios.index') }}">Ver usuarios</a>
          @env('admins.index')
          <a class="dropdown-item" href="{{ route('admins.index') }}">Ver admins</a>
          @endenv
          @env('accesos.create')
          <a class="dropdown-item" href="{{ route('accesos.index') }}">Ver permisos</a>
          <!-- <a class="dropdown-item" onclick="openiframe('Nueva ruta','{{ route('accesos.create')}}')">Crear permiso</a> -->
          @endenv
          @env('equipos.index')
          <a class="dropdown-item" href="{{ route('equipos.index') }}">Ver equipos</a>
          @endenv
          @env('personas.index')
          <a class="dropdown-item" href="{{ route('personas.index') }}">Ver participantes</a>
          @endenv
        </div>
      </li>
      @endenv
      <!-- <li class="nav-item">
        <a class="nav-link text-white {{ (request()->is('admins')) ? $bg->custombackground : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">group</i>
            </div>
            <span class="nav-link-text ms-1 w-100">Admins</span><i class="material-icons opacity-10 text-white text-right fs-6">keyboard_arrow_down</i>
        </a>
        <div class="dropdown-menu mx-3" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('admins.index') }}">Ver admins</a>
          <a class="dropdown-item" onclick="openiframe('Nuevo admin','{{ route('admins.create')}}')">Añadir admin</a>
        </div>
      </li> -->
      @env('historial.index')
      <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('historial')) ? $bg->custombackground : '' }} " href="{{ url('historial') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Historial</span>
          </a>
        </li>
        @endenv
        @env('tareas.index')
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('tareas')) ? $bg->custombackground : '' }} " href="{{ url('tareas') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">task</i>
            </div>
            <span class="nav-link-text ms-1">Tareas</span>
          </a>
        </li>
        @endenv
        @env('areas.index')
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('areas')) ? $bg->custombackground : '' }} " href="{{ url('areas') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">home_work</i>
            </div>
            <span class="nav-link-text ms-1">Areas</span>
          </a>
        </li>
        @endenv
        <!-- <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Videoconferencias</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('usuarios/perfil')) ? $bg->custombackground : '' }} " href="{{ url('usuarios/perfil') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">videocam</i>
            </div>
            <span class="nav-link-text ms-1">Registrar solicitud</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('usuarios/perfil')) ? $bg->custombackground : '' }} " href="{{ url('usuarios/perfil') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">calendar_today</i>
            </div>
            <span class="nav-link-text ms-1">Calendario</span>
          </a>
        </li> -->
        @endif
        @env('conferencias.index')
        <li class="nav-item mt-3">
          <a class="nav-link text-white">
          <span class="text-uppercase text-xs font-weight-bolder opacity-8">Videoconferencias</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('calendario')) ? $bg->custombackground : '' }} " href="{{ route('conferencias.calendario') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">event</i>
            </div>
            <span class="nav-link-text ms-1">Calendario</span>
          </a>
        </li>

      <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('conferencias')) ? $bg->custombackground : '' }} " href="{{ route('conferencias.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">videocam</i>
            </div>
            @if(Auth::user()->tipo_usuario==1)
            <span class="nav-link-text ms-1">Mis conferencias</span>
            @else
            <span class="nav-link-text ms-1">Conferencias</span>
            @endif
          </a>
        </li>
      @endenv

      @env('archivo')
      <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('archivo')) ? $bg->custombackground : '' }} " href="{{ route('archivo') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">rule_folder</i>
            </div>
            <span class="nav-link-text ms-1">Archivo</span>
          </a>
        </li>
      @endenv
      @env('direcciones.index')
      <li class="nav-item">
        <a class="nav-link text-white {{ (request()->is('direcciones')) ? $bg->custombackground : '' }} {{ (request()->is('subdirecciones')) ? $bg->custombackground : '' }} {{ (request()->is('departamentos')) ? $bg->custombackground : '' }} {{ (request()->is('sedes')) ? $bg->custombackground : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">apartment</i>
            </div>
            <span class="nav-link-text ms-1 w-100">Sectores</span><i class="material-icons opacity-10 text-white text-right fs-6">keyboard_arrow_down</i>
        </a>
        <div class="dropdown-menu mx-3" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('direcciones.index') }}">Direcciones</a>
          <a class="dropdown-item" href="{{ route('subdirecciones.index') }}">Subdirecciones</a>
          <a class="dropdown-item" href="{{ route('departamentos.index') }}">Departamentos</a>
          <a class="dropdown-item" href="{{ route('sedes.index') }}">Sedes</a>
        </div>
      </li>
      @endenv
      @env('reportes.ordenes')
      <li class="nav-item mt-3">
          <a class="nav-link text-white">
          <span class="text-uppercase text-xs font-weight-bolder opacity-8">Reportes</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('reporte/ordenes')) ? $bg->custombackground : '' }} " href="{{ url('reportes/ordenes') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">bar_chart</i>
            </div>
            <span class="nav-link-text ms-1">Ordenes</span>
          </a>
        </li>
        @endenv
        <li class="nav-item mt-3">
          <a class="nav-link text-white">
          <span class="text-uppercase text-xs font-weight-bolder opacity-8">Cuenta</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ (request()->is('usuarios/perfil')) ? $bg->custombackground : '' }} " href="{{ url('usuarios/perfil') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn {{$bg->custom}} mt-4 w-100" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="button"><i class="fa fa-sign-out me-sm-1 pr-2"></i>Cerrar sesión</a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </div>
    </div>
  </aside>
        
        <!-- Page Content  -->

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 pb-0 pt-1 px-0 me-sm-6 me-5" style="background-color: transparent">
            <li class="breadcrumb-item text-sm opacity-9 text-dark mt-3" href="javascript:;">SOS</li>
            <!-- <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li> -->
          </ol>
          <h4 id="titulo" class="font-weight-bolder mb-0">Sistema de Ordenes de Servicio</h4>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <!-- <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div> -->
          </div>
          <ul class="navbar-nav  justify-content-end">
            <!-- <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">{{Auth::user()->nombreCompleto}}</span>
              </a>
            </li> -->
            <li class="nav-item d-flex align-items-center d-none d-sm-block">
              <div class="dropdown">
              <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle me-sm-1"></i>
                <span class="d-sm-inline d-none">{{Auth::user()->nombreCompleto}}</span>
              </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{{ url('usuarios/perfil') }}"><i class="fa fa-user me-sm-1 pr-2"></i>Perfil</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="button"><i class="fa fa-sign-out me-sm-1 pr-2"></i>Cerrar sesión</a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
                </div>
              </div>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-0">
             @yield('content')
<footer class="footer py-3">
        <div class="container-fluid p-0">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 pl-3">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <a href="https://www.ssm.gob.mx" class="font-weight-bold" target="_blank">Servicios de Salud de Morelos</a> <script>
                  document.write(new Date().getFullYear())
                </script>
              </div>
            </div>
          </div>
        </div>
      </footer>
        </div>
      </div>
      
    </div>
  </main>
  @if(Auth::user()->id==2 || Auth::user()->id==4)
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Configuración SOS</h5>
          <p>Personaliza el dashboard de todos los usuarios</p>
        </div>
        <div class="float-end mt-0 pt-0">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Color elementos</h6>
          <p class="text-sm">Botones y link activo del menú</p>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
          
{!! Form::open(array('route' => array('usuarios.custom'),'method'=>'post','class'=>'container')) !!}

    {!! Form::hidden('custom',$bg->customcolor,array('class' => '', 'id' => 'custom'))!!}
    {!! Form::hidden('custom2',$bg->custommode,array('class' => '', 'id' => 'custom2'))!!}
    {!! Form::hidden('custom3',$bg->custommenu,array('class' => '', 'id' => 'custom3'))!!}
    {!! Form::hidden('custom4',$bg->customother,array('class' => '', 'id' => 'custom4'))!!}

    <button id="toSend" type="submit"class="btn d-none">
      </button>
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="bgcolor(this)"></span>
            <span class="badge filter bg-gradient-dark" type="submit" data-color="dark" onclick="bgcolor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="bgcolor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="bgcolor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="bgcolor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="bgcolor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Color menú</h6>
          <p class="text-sm">Color de fondo menú lateral</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 {{$bg->custommenu=='bg-gradient-dark' ? 'active' : ''}}" data-class="bg-gradient-dark" onclick="menucolor(this)">Negro</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2 {{$bg->custommenu=='bg-transparent' ? 'active' : ''}}" data-class="bg-transparent" onclick="menucolor(this)">Morado</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2 {{$bg->custommenu=='bg-white' ? 'active' : ''}}" data-class="bg-white" onclick="menucolor(this)">Blanco</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Modo oscuro</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            @if($bg->custommode=='dark-version')
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="modcolor(this)" checked>
            @else
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="modcolor(this)">
            @endif
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="row">
          <div class="mt-3">
          <h6 class="mb-0">Ordenes antiguas</h6>
          <p class="text-sm">Límite de días a mostrar</p>
        </div>
        <div class="col-md-12 mb-3">
      <div class="input-group">
        <input type="number" class="form-control form-gray" id="limite" placeholder="Límite de días" aria-describedby="dias" value="{{$bg->customother}}">
      </div>
    </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  @endif
  </div> 

       <!--Modal: Name-->
  <div class="row">
  <div class="col-lg-4 col-md-12 mb-4">
  <div class="modal fade" id="modaliframe"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="dialog">
      <div class="modal-content">
        <div class="modal-header {{$bg->custombackground}}">
          <h5 class="modal-title text-md text-white" id="modaltitulo"></h5>
          <button type="button" onclick=" window.parent.closeModal();" class="close" data-dismiss="modal" aria-label="Close" > 
            <span aria-hidden="true" >&times;</span>
          </button>
        </div>
        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
            <iframe class="embed-responsive-item" id="iframemarca" src=""  frameborder="0" allowfullscreen></iframe>
          </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>
  </div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background: transparent;">
      <div class="modal-header border-bottom-0" style="background: rgb(92,37,118,0.6)!important;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#loginModal').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background: rgb(92,37,118,0.6)!important;">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 justify-content-center">
            <a id="menu-1" href="{{ route('home') }}">
              <img src="{{URL::asset('/image/menu/ordenes-2.png')}}" alt="logo_SSM" class="img-responsive menu-img" width="100" style="margin: 0 auto; display: block;">
              <h6 class="text-center text-white delimiter mt-2 mb-3">Solicitar orden de servicio</h6>
            </a>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 justify-content-center">
            <a id="menu-2" href="{{ route('conferencias.calendario') }}">
              <img src="{{URL::asset('/image/menu/conferencias-2.png')}}" alt="logo_SSM" class="img-responsive menu-img" width="100" style="margin: 0 auto; display: block;">
              <h6 class="text-center text-white delimiter mt-2 mb-3">Solicitar videoconferencia</h6>
            </a>
          </div>
        </div>
    </div>
  </div>
</div>
</div>


  <!--Modal: Name-->

    @yield('modals')

    <div class="position-fixed bottom-4 end-1 z-index-2">
        <div class="toast fade hide p-2" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
          <div class="toast-header border-0">
            <i class="material-icons text-success me-2">
        check
      </i>
            <span class="me-auto font-weight-bold">Operación exitosa</span>
            <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
          </div>
          <hr class="horizontal dark m-0">
          <div class="toast-body">
            El registro fue procesado correctamente.
          </div>
        </div>
        <div class="toast fade hide p-2 mt-2" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
          <div class="toast-header border-0">
            <i class="material-icons text-danger me-2">
        campaign
      </i>
            <span class="me-auto text-gradient text-danger font-weight-bold">Operación fallida</span>
            <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
          </div>
          <hr class="horizontal dark m-0">
          <div class="toast-body">
             @if(Auth::user()->tipo_usuario==1)
             El registro no fue procesado correctamente.
             @else
             <span id="nook"></span>
             @endif
          </div>
        </div>
    </div>
</body>


<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ URL::asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ URL::asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ URL::asset('js/plugins/bootstrap.min.js') }}"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script type="text/javascript">
  $(document).ready(function(){
  localStorage.setItem('res','');
  setTimeout(function(){
     history.go(0);
     localStorage.setItem('res','');
}, 360000);

  if ($(window).width() < 700) {
        $('.embed-responsive').css({"height": "100%"});
        $(".modal-content").css({"height": "90vh"});
        $("body").css({"overflow-y": "auto"});
      }

  $('#menu-1').on('click', function () {
            localStorage.setItem("menu",'true');
         });
  $('#menu-2').on('click', function () {
            localStorage.setItem("menu",'true');
         });

  $("#cat_area").select2({theme: 'bootstrap4'}); 
  $("#cat_tarea").select2({theme: 'bootstrap4'});  
  $("#cat_equipo").select2({theme: 'bootstrap4'});
  $("#cat_dir").select2({theme: 'bootstrap4', width:'100%'});
  $("#cat_sub").select2({theme: 'bootstrap4', width:'100%'});
  $("#cat_dep").select2({theme: 'bootstrap4', width:'100%'});
  $("#cat_sed").select2({theme: 'bootstrap4', width:'100%'});
  $("#cat_rec").select2({theme: 'bootstrap4', width:'100%'});
  $("#cargo").select2({theme: 'bootstrap4', width:'100%'});

  var color = document.getElementById("c").value;
  if (color == 'bg-white') {
    var textWhites = document.querySelectorAll('.sidenav .text-white');
    for (let i = 0; i < textWhites.length; i++) {
      textWhites[i].classList.remove('text-white');
      textWhites[i].classList.add('text-dark');
      if(textWhites[i].classList.contains("active") || textWhites[i].classList.contains("btn")){
      textWhites[i].classList.remove('text-dark');
      textWhites[i].classList.add('text-white');
      }
    }
  } else {
    var textDarks = document.querySelectorAll('.sidenav .text-dark');
    for (let i = 0; i < textDarks.length; i++) {
      textDarks[i].classList.add('text-white');
      textDarks[i].classList.remove('text-dark');
    }
  }               
});

localStorage.setItem('res','');

    $('#modaliframe').on('hidden.bs.modal', function () {
        var val = localStorage.getItem('res');

if(val != ''){
  if (val == 'ok'){
    setTimeout(() => {
        $("#successToast").toast("show");
    }, 100);
    localStorage.getItem('res', '');
    setTimeout(function(){
     history.go(0);
}, 2500);
    }else{
    @if(Auth::user()->tipo_usuario==2)
    document.getElementById("nook").textContent = val;
    @endif
    setTimeout(() => {
        $("#dangerToast").toast("show");
    }, 100);
    localStorage.getItem('res', '');
    setTimeout(function(){
      @if(Auth::user()->tipo_usuario==1)
      history.go(0);
      @endif
}, 2500);
    }
  }

});

</script>

<script type="text/javascript" src="{{ URL::asset('js/plantilla.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dashboard-sos.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dashboard-sos.min.js') }}"></script>



</html>
