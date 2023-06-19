@extends('layouts.modal')

@section('content')
  {!! Form::open(array('route' => array('areas.store', $area),'method'=>'post','class'=>'container')) !!}
<br>
<div class="container">
    <div class="row justify-content-center">
    @csrf
    <div class="col-3 mt-2">
        {!! Form::label('','CVE') !!}
        {!! Form::text('cve',$area->cve,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Cve', 'required'))!!}
    </div>
    <div class="col-7 mt-2">
        {!! Form::label('','Area') !!}
        {!! Form::text('area',$area->area,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre', 'required'))!!}
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11">{!! Form::label('','Usuarios denegados para esta área:') !!}  </div>
        
        @foreach($admins as $key => $admin) 
        <div class="col-4">
          <div class="form-check">
             <input type="checkbox"  id="{{$admin->id}}" name="{{$admin->id}}" {{$checkperfil[$key]==1 ? 'checked' : ''}}>
             <label class="form-check-label" for="{{$admin->id}}">
              {{$admin->username}}
            </label>
         </div>   
        </div>
        @endforeach
    </div>
    <br>
    
            </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn {{$bg->custom}}">
                                    Guardar
                                </button><br><br>
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

