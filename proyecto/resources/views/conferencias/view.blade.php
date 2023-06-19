@extends('layouts.modal')
@section('content')
{!! Form::open(array('route' => array('conferencias.store', $conferencia),'method'=>'post','class'=>'container')) !!}
<style type="text/css">
   .circulo {
   width: 3rem;
   height: 3rem;
   border-radius: 50%;
   display: flex;
   align-items: center;
   justify-content: center;
   margin:0px auto;
   padding:2%;
}

.circulo > h3 {
   font-family: sans-serif;
   color: white;
   font-size: 1.4rem;
   font-weight: bold;
}
</style>
<br>
<div class="container-fluid p-0">
   <div class="row">
      @csrf
      @if($bg->customcolor == 'primary')
      <div class="card h-100 mb-4" style="background-image: url('{{URL::asset("/image/avatar/banner_bottom.png")}}'); background-size: cover; background-position: bottom;">
      @else
      <div class="card h-100 mb-4" style="background-color: lavender;">
      @endif
            <div class="mt-4 pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">{{$conferencia->nombre}}</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                  <i class="material-icons me-2 text-lg">date_range</i>
                  <small>{{$conferencia->feini}} / {{$conferencia->fefin}}</small>
                </div>
              </div>
            </div>
            <div class="card-body pt-4 p-3 mt-1">
               <div class="row">
                <div class="col-md-6">
                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">{{$conferencia->usuario->nombreCompleto}}</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                  <h6 class="text-uppercase text-body text-xs font-weight-bold mb-3">{{$conferencia->tipo}}</h6>
                </div>
              </div>
              <ul class="list-group mt-4">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg" style="background-color: rgb(250,250,250,0.8);">
                  <div class="d-flex align-items-center">
                     <span class="circulo mx-2 bg-{{$bg->customcolor}}">
                       <h3 class="m-0 icon-letter">{{$conferencia->sedes->ide}}</h3>
                     </span>
                    
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Sede emisora</h6>
                      <span class="text-xs text-dark">{{$conferencia->sedes->nombre}}</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-gradient text-sm font-weight-bold">
                      <div class="avatar-group mt-2 text-right">
                        @foreach($receptores as $key => $recep)
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$recep}}">
                            <img src="{{URL::asset('/image/avatar/invitado.png')}}" alt="team1">
                          </a>
                          @endforeach
                        </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
   <div class="form-group row mb-0 text-center mt-4">
      <div class="col-12">
         <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button><br><br>
      </div>
   </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
   localStorage.setItem('res','');
    @if(session('ok'))
    localStorage.setItem('res','ok');
    window.parent.closeModal();
    @elseif(session('nook'))
    localStorage.setItem('res','{{Session::get('nook')}}');
    window.parent.closeModal();
    @endif
</script>
@endsection