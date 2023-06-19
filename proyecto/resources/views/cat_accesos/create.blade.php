@extends('layouts.modal')
@section ('content')
  {!! Form::open(array('route' => array('accesos.store'),'method'=>'post','class'=>'container')) !!}
    <div class="card-body">
            {!! Form::token() !!}
                    {!! Form::label('Nombre','') !!}
                    {!! Form::text('nombre','',array('class' => 'form-control form-gray','required'))!!}
                    {!! Form::label('Ruta','') !!}
                    {!! Form::text('Ruta','',array('class' => 'form-control form-gray','required'))!!}
             <br>
             {!! Form::label('Autorizar: ','') !!}       
            <div class="row">
                <div class="col-3">
                  <div class="form-check">
                     <input type="checkbox"  id="1" name="1">
                     <label class="form-check-label" for="1">
                      Normal
                    </label>
                 </div>   
                </div>
                <div class="col-3">
                  <div class="form-check">
                     <input type="checkbox"  id="2" name="2">
                     <label class="form-check-label" for="2">
                      Master
                    </label>
                 </div>   
                </div>
                <div class="col-3">
                  <div class="form-check">
                     <input type="checkbox"  id="3" name="3">
                     <label class="form-check-label" for="3">
                      Administrador
                    </label>
                 </div>   
                </div>
                <div class="col-3">
                  <div class="form-check">
                     <input type="checkbox"  id="4" name="4">
                     <label class="form-check-label" for="4">
                      Técnico
                    </label>
                 </div>   
                </div>  
            </div>
                     <div class="card-body text-center mt-4">
                    <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    <button type="submit"class="btn {{$bg->custom}}">Guardar</button>
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