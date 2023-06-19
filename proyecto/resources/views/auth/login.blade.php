@extends('layouts.app')

@section('content')
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col text-center">
                <figure class="mb-5">
                    <img src="{{URL::asset('/image/ssm_logo.png')}}" alt="logo_SSM" width="270px;" class="img-responsive"><br>
                </figure>
            </div>                
                    @if(!empty($errorlog))
                        <div id="alerta" class="position-fixed top-8 end-2 alert alert-danger-opacity alert-dismissible fade show" role="alert"><a class="text-white"><i class="material-icons text-white text-sm scale px-2">error_outline</i><strong>Ups! </strong>{{$errorlog}}</a>
   <button type="button" class="close pt-2" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">×</span>
   </button>
</div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Usuario"  autofocus>   
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       <div class="form-group row justify-content-center">

                            <div class="col-md-6 mt-4">
                                <button type="submit" class="btn btn-platzi btn-block text-white bg-gradient-primary text-capitalize">
                                   Ingresar
                                </button>
                                <a href="{{route('actua')}}" class="btn btn-platzi btn-block text-white bg-gradient-primary text-capitalize">
                                   Cambiar contraseña
                                </a>  
                                <p class="mt-6 mb-3 text-muted text-center text-white text-sm">&copy;Servicios de Salud Morelos <?php echo date("Y");?></p>
                            </div>
                        </div>
                       
                        
                    </form>
        </div>
    </div>
    <div class="position-fixed bottom-4 end-1 z-index-2">
        <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
          <div class="toast-header border-0">
            <i class="material-icons text-success me-2">
        check
      </i>
            <span class="me-auto font-weight-bold">Registro exitoso </span>
            <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
          </div>
          <hr class="horizontal dark m-0">
          <div class="toast-body">
            El registro fue procesado correctamente.
          </div>
        </div>
        <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
          <div class="toast-header border-0">
            <i class="material-icons text-danger me-2">
        campaign
      </i>
            <span class="me-auto text-gradient text-danger font-weight-bold">Registro fallido </span>
            <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
          </div>
          <hr class="horizontal dark m-0">
          <div class="toast-body">
             El registro no fue procesado correctamente.
          </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    localStorage.setItem('menu','false');
    
    @if (session('ok'))
    setTimeout(() => {
        $("#successToast").toast("show");
    }, 200);
    @endif
    @if (session('nook'))
    setTimeout(() => {
        $("#dangerToast").toast("show");
    }, 200);
    @endif
</script>

@endsection
